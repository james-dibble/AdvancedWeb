<?php
class Quote{
    public function __construct($category, $quote, $author){
        $this->Category = $category;
        $this->Quote = $quote;
        $this->Author = $author;
    }
}

class Author {
    public function __construct($name, $dob, $dod, $url, $image){
        $this->Name = $name;
        $this->DOB = $dob;
        $this->DOD = $dod;
        $this->Url = $url;
        $this->Image = $image;
    }
}

class QuoteParser {
    public static function ParseFile($fileUrl){
        $doc = simplexml_load_file($fileUrl);
                
        $quotes = [];
        
        foreach($doc->children() as $quote){
            array_push($quotes, QuoteParser::ParseQuote($quote));
        }
        
        return $quotes;
    }
    
    private static function ParseQuote($quoteNode){
        $category = $quoteNode->attributes()->category;
        $text = $quoteNode->text;
        
        $author = QuoteParser::ParseAuthor($quoteNode->author);
        
        return new Quote($category, $text, $author);
    }
    
    private static function ParseAuthor($authorNode){
        $name = $authorNode->name;
        $dob = $authorNode->dob;
        $dod = $authorNode->dod;
        $url = $authorNode->url;
        $img = $authorNode->img;
        
        return new Author($name, $dob, $dod, $url, $img);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>DOM Manipulation</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
            $quotes = QuoteParser::ParseFile('quotes.xml');
            
            foreach($quotes as $parsed){
echo <<<HTML
     <table class="table table-striped">
        <tr>
            <th class="col-lg-2">Category</th>
            <td>{$parsed->Category}</td>
        </tr>
        <tr>
            <th class="col-lg-2">Quote</th>
            <td>{$parsed->Quote}</td>
        </tr>
            <tr>
            <th class="col-lg-2">Author</th>
            <td><a href="{$parsed->Author->Url}" title="{$parsed->Author->Name}">{$parsed->Author->Name}</a></td>
        </tr>
            <tr>
            <th class="col-lg-2">Date</th>
            <td>{$parsed->Author->DOB}-{$parsed->Author->DOD}</td>
        </tr>
        <tr>
            <th class="col-lg-2">Image</th>
            <td><img src="{$parsed->Author->Image}" alt="{$parsed->Author->Name}" class="col-lg-3 col-md-3" /></td>
        </tr>
     </table>
HTML;
            }
        ?>
    </body>
</html>
