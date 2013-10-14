<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>
    <xsl:template match="/shop/categories">
    </xsl:template>
    <xsl:template match="/shop/products">
        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>XSLT Transformation</title>
                <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" />
            </head>
            <body>
                <div class="container">
                    <div class="row">
                        <xsl:apply-templates />
                    </div>
                </div>
            </body>
        </html>
    </xsl:template>
    <xsl:template match="product">
        <table class="table table-striped table-hover">
            <tr>
                <th>category</th>
                <td>
                    <xsl:apply-templates select="product_categories/category" />
                </td>
            </tr>
            <tr>
                <th>id</th>
                <td>
                    <xsl:value-of select="@product_id"/>
                </td>
            </tr>
            <tr>
                <th>product</th>
                <td>
                    <xsl:value-of select="name"/>
                </td>
            </tr>
            <tr>
                <th>description</th>
                <td>
                    <xsl:value-of select="description"/>
                </td>
            </tr>
            <tr>
                <th>rrp</th>
                <td>
                    <xsl:value-of select="rrp"/>
                </td>
            </tr>
            <tr>
                <th>price</th>
                <td>
                    <xsl:value-of select="price"/>
                </td>
            </tr>
            <tr>
                <th>manufacturer</th>
                <td>
                    <xsl:value-of select="manufacturer"/>
                </td>
            </tr>
            <tr>
                <th>image</th>
                <td>
                    <img src="{image}" class="col-lg-2" />
                </td>
            </tr>
            <tr>
                <th>keywords</th>
                <td>
                    <xsl:apply-templates select="keywords/keyword" />
                </td>
            </tr>
        </table>
    </xsl:template>
    <xsl:template match="keywords/keyword">
        <xsl:if test="not(position()=1)"> | </xsl:if>
        <xsl:value-of select="." />
    </xsl:template>
    <xsl:template match="product_categories/category">
        <xsl:variable name="category" select="." />
        <xsl:if test="not(position()=1)">, </xsl:if>
        <xsl:value-of select="/shop/categories/category[@category_id=$category]"/>
    </xsl:template>
</xsl:stylesheet>