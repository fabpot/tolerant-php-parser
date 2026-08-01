# Getting Started

## Requirements

Install PHP 8.1 or later and [Composer](https://getcomposer.org/download/). Verify both are available:

```console
php -v
composer --version
```

## Install `tolerant-php-parser`

Add the VCS repository and install the package:

```console
composer config repositories.tolerant-php-parser vcs https://github.com/fabpot/tolerant-php-parser
composer require fabpot/tolerant-php-parser:^0.2
```

## Ready, set, parse!

```php
<?php
// Autoload required classes
require __DIR__ . "/vendor/autoload.php";

use Microsoft\PhpParser\{DiagnosticsProvider, Parser};

$parser = new Parser(); # instantiates a new parser instance
$astNode = $parser->parseSourceFile('<?php /* comment */ echo "hi!";'); # returns an AST from string contents
$errors =  DiagnosticsProvider::getDiagnostics($astNode); # get errors from AST Node (as a Generator)

var_dump($astNode); # prints full AST
var_dump(iterator_to_array($errors)); # prints all errors

$childNodes = $astNode->getChildNodes();
foreach ($childNodes as $childNode) {
    var_dump([
        "kind" => $childNode->getNodeKindName(), 
        "fullText" => $childNode->getFullText(),
        "text" => $childNode->getText(),
        "trivia" => $childNode->getLeadingCommentAndWhitespaceText()
    ]);
}

// For instance, for the expression-statement, the following is returned:
//   array(4) {
//     ["kind"]=>
//     string(19) "ExpressionStatement"
//     ["fullText"]=>
//     string(25) "/* comment */ echo "hi!";"
//     ["text"]=>
//     string(11) "echo "hi!";"
//     ["trivia"]=>
//     string(14) "/* comment */ "
//   }
```

> Note: the API is not yet finalized, so please file issues let us know what functionality you want exposed, 
and we'll see what we can do! Also please file any bugs with unexpected behavior in the parse tree. We're still
in our early stages, and any feedback you have is much appreciated :smiley:.

## Play around with the AST!
In order to help you get a sense for the features and shape of the tree, 
we've also included a [Syntax Visualizer Tool](../syntax-visualizer/client#php-parser-syntax-visualizer-tool)
that makes use of the parser to both visualize the tree and provide error tooltips.
![image](https://cloud.githubusercontent.com/assets/762848/21635753/3f8c0cb8-d214-11e6-8424-e200d63abc18.png)

![image](https://cloud.githubusercontent.com/assets/762848/21705272/d5f2f7d8-d373-11e6-9688-46ead75b2fd3.png)

If you see something that looks off, please file an issue, or better yet, contribute as a test case. See [Contributing.md](../Contributing.md) for more details.

## Next Steps
Check out the [Syntax Overview](Overview.md) section for more information on key attributes of the parse tree, 
or the [How It Works](HowItWorks.md) section if you want to dive deeper into the implementation.
