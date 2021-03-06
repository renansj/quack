<?php
/**
 * Quack Compiler and toolkit
 * Copyright (C) 2016 Marcelo Camargo <marcelocamargo@linuxmail.org> and
 * CONTRIBUTORS.
 *
 * This file is part of Quack.
 *
 * Quack is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Quack is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Quack.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace QuackCompiler\Ast\Expr;

use \QuackCompiler\Lexer\Tag;
use \QuackCompiler\Lexer\Token;
use \QuackCompiler\Parser\Parser;

class PrefixExpr implements Expr
{
  private $operator;
  private $right;

  public function __construct(Token $operator, Expr $right)
  {
    $this->operator = $operator->getTag();
    $this->right = $right;
  }

  public function format(Parser $parser)
  {
    $string_builder = [];
    if ($this->operator === Tag::T_NOT) {
      $string_builder[] = 'not ';
    } else {
      $string_builder[] = $this->operator;
    }

    $string_builder[] = $this->right->format($parser);

    return implode($string_builder);
  }

  public function python(Parser $parser)
  {
    $string_builder = [];
    if ($this->operator === Tag::T_NOT) {
      $string_builder[] = '!';
    } else if ($this->operator === '*') {
      // pass
    } else {
      $string_builder[] = $this->operator;
    }

    $string_builder[] = $this->right->python($parser);
    return implode($string_builder);
  }
}
