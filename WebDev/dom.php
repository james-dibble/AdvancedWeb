<?php
class Quote{
    public $_category = '';
    public $_quote = '';
    public $_author = '';
    public $_date = '';
    public $_imageUrl = '';
    
    public function __construct($category, $quote, $author, $date, $image){
        $this->$_category = $category;
        $this->$_quote = $quote;
        $this->$_author = $author;
        $this->$_date = $date;
        $this->$_imageUrl = $image;
    }
}

class QuoteParser {
    public static function ParseFile($fileUrl){
        $doc = new DOMDocument();
        $doc->load($fileUrl);
        
        $quotes = [];
        
        foreach($doc->getElementsByTagName('quote') as $quote){
            array_push($quotes, QuoteParser::ParseCategory($quote));
        }
        
        return $quotes;
    }
    
    private static function ParseCategory($quoteNode){
        $category = $quoteNode->getAttribute('category');
                
        return new Quote($category, '', '', '', '');
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $quotes = QuoteParser::ParseFile('quotes.xml');
            
            foreach($quotes as $parsed){
echo <<<HTML
     <table>
                <tr>
                <th>Category</th>
                <td>$parsed</td>
                </tr>
     </table>
HTML;
            }
        ?>
    </body>
</html>
