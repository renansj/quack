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
namespace QuackCompiler\Ast\Stmt;

use \QuackCompiler\Parser\Parser;

class BreakStmt implements Stmt
{
  public $label;

  public function __construct($label = NULL)
  {
    $this->label = $label;
  }

  public function format(Parser $parser)
  {
    $string_builder = ['break'];

    if (!is_null($this->label)) {
      $string_builder[] = ' ';
      $string_builder[] = $this->label->format($parser);
    }

    $string_builder[] = PHP_EOL;

    return implode($string_builder);
  }
}
