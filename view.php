<?php
defined('C5_EXECUTE') or die("Access Denied.");
if (is_numeric($atndid) && $atndid > 0) {
    $atndurl = 'http://api.atnd.org/events/users/?event_id=' . (int)$atndid;
    $atnddata = @file_get_contents($atndurl);
} else {
    /**
     * sampledata 
     * http://api.atnd.org/#events-url
     */
    $atnddata =<<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<hash>
  <results_returned type="integer">1</results_returned>
  <results_available type="integer">1</results_available>
  <results_start type="integer">1</results_start>
  <events type="array">
    <event>
      <event_id type="integer">757</event_id>
      <title>Tokyo Cloud Developers Meetup #02</title>
      <event_url>http://atnd.org/events/757</event_url>
      <limit type="integer">80</limit>
      <accepted type="integer">80</accepted>
      <waiting type="integer">15</waiting>
      <updated_at type="datetime">2009-06-04T11:56:20Z</updated_at>
      <users type="array">
        <user>
          <user_id type="integer">152</user_id>
          <nickname>ngs</nickname>
          <twitter_id>ngs</twitter_id>
          <status type="integer">1</status>
        </user>
      </users>
    </event>

  </events>
</hash>
EOF;
} // if (is_numeric($atndid))


/**
 * XML file
 */
try {
    $xmldata = new DOMDocument();
    $xmldata->loadXml($atnddata);
} catch (DOMException $e) {
    echo '捕捉した例外: ' . $e->getMessage();
}


/**
 * XSL file
 */
$xsl = $b->getBlockPath() . '/view.xsl';
try {
    $xsldata = new DOMDocument();
    $xsldata->load($xsl);
} catch (DOMException $e) {
    echo '捕捉した例外: ' . $e->getMessage();
}

/**
 *  create XSLT processor object
 */
$processor = new xsltprocessor();
$processor->importStyleSheet($xsldata);

/**
 * Convert format
 */
try {
    $output = $processor->transformToXML($xmldata);
} catch (DOMException $e) {
    echo '捕捉した例外: ' . $e;
}

/**
 * Result
 */
echo $output;
?>
