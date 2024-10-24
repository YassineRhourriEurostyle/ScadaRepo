<?php

namespace App\DQL;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;

/**
 * "ROUND" "(" {SimpleArithmeticExpression "," ArithmeticPrimary} ")"
 */
class Round extends FunctionNode {

    public $firstNumberExpression;
    public $secondNumberExpression;
    
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER); // (2)
        $parser->match(Lexer::T_OPEN_PARENTHESIS); // (3)
        $this->firstNumberExpression = $parser->SimpleArithmeticExpression(); // (4)
        $parser->match(Lexer::T_COMMA); // (5)
        $this->secondNumberExpression = $parser->ArithmeticPrimary(); // (6)
        $parser->match(Lexer::T_CLOSE_PARENTHESIS); // (3)
    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'ROUND(' .
            $this->firstNumberExpression->dispatch($sqlWalker) . ', ' .
            $this->secondNumberExpression->dispatch($sqlWalker) .
        ')'; // (7)
    }
}
