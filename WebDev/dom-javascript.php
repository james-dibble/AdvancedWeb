<!DOCTYPE html>
<html data-ng-app="">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>DOM Manipulation</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container" data-ng-controller="quoteController">
            <h1 data-ng-show="loading">Loading...</h1>
            <table class="table table-striped" data-ng-repeat="quote in quotes">
                <tr>
                    <th class="col-lg-2">Category</th>
                    <td>{{quote.category}}</td>
                </tr>
                <tr>
                    <th class="col-lg-2">Quote</th>
                    <td>{{quote.quote}}</td>
                </tr>
                <tr>
                    <th class="col-lg-2">Author</th>
                    <td><a href="{{quote.author.url}}" title="{{quote.author.name}}">{{quote.author.name}}</a></td>
                </tr>
                <tr>
                    <th class="col-lg-2">Date</th>
                    <td>{{quote.author.dob}}-{{quote.author.dob}}</td>
                </tr>
                <tr>
                    <th class="col-lg-2">Image</th>
                    <td><img src="{{quote.author.image}}" alt="{{quote.author.name}}" class="col-lg-3 col-md-3" /></td>
                </tr>
            </table>
        </div>
    </body>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/angularjs/1.1.5/angular.min.js"></script>
    <script type="text/javascript">
        function quoteController($scope, $http) {
            $scope.loading = true;
            $scope.quotes = [];

            $http({method: 'GET', url: 'quotes.xml'})
                    .success(function(data) {
                var quotes = $(data).children('quote');

                $(quotes).each(function(index, quote){
                    $scope.quotes.push(getQuote(quote));
                });

                $scope.loading = false;
            });

            var getQuote = function(quote) {
                var category = $(quote).attr('category');
                var quoteText = $(quote).children('text').first().text();
                var authorNode = $(quote).children('author').first();
                var author = getAuthor(authorNode);

                var quoteObject = {
                    category: category,
                    quote: quoteText,
                    author: author
                };

                return quoteObject;
            };

            var getAuthor = function(author) {
                var authorObject = {
                    name: $(author).children('name').first().text(),
                    url: $(author).children('url').first().text(),
                    dob: $(author).children('dob').first().text(),
                    dod: $(author).children('dod').first().text(),
                    image: $(author).children('img').first().text()
                };

                return authorObject;
            };
        }
    </script>
</html>
