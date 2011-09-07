<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="no"
        omit-xml-declaration="yes"  media-type="text/html"/>
    <xsl:template match="/">
        <xsl:value-of select="hash/events/event/title"/><br />
        Attendees<br />
        <xsl:for-each select ="hash/events/event/users/user">
            <xsl:value-of select="nickname"/><br />
        </xsl:for-each>
    </xsl:template>
</xsl:stylesheet>
