<?php

namespace App\Services;

use App\Repositories\HistoryRepository;

class CalculatorService
{
    protected $historyRepository;

    public function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function calculate($expression)
    {
        try {
            $result = $this->evaluateExpression($expression);
            return $this->logHistory($expression, $result);

        } catch (\Exception $e) {
            \Log::error("Error in calculation: {$e->getMessage()}");
            return null;
        }
    }

    protected function logHistory($expression, $result)
    {
        return $this->historyRepository->log([
            'expression' => $expression,
            'result' => $result
        ]);
    }

    public function getHistory()
    {
        return $this->historyRepository->get();
    }

    protected function evaluateExpression($expression)
    {
        $tokens = $this->tokenizeExpression($expression);
        $postfix = $this->convertToPostfix($tokens);
        $result = $this->evaluatePostfix($postfix);

        return $result;
    }

    protected function tokenizeExpression($expression)
    {
        preg_match_all('/(?:\d+|\S)/', $expression, $matches);
        return $matches[0];
    }

    protected function convertToPostfix($tokens)
    {
        $output = [];
        $stack = [];

        foreach ($tokens as $token) {
            if (is_numeric($token)) {
                $output[] = $token;
            } elseif ($token == '(' || $token == '[' || $token == '{') {
                $stack[] = $token;
            } elseif ($token == ')' || $token == ']' || $token == '}') {
                while (!empty($stack) && end($stack) != '(' && end($stack) != '[' && end($stack) != '{') {
                    $output[] = array_pop($stack);
                }
                array_pop($stack);
            } else {
                while (!empty($stack) && $this->getPrecedence(end($stack)) >= $this->getPrecedence($token)) {
                    $output[] = array_pop($stack);
                }
                $stack[] = $token;
            }
        }

        while (!empty($stack)) {
            $output[] = array_pop($stack);
        }

        return $output;
    }


    protected function evaluatePostfix($postfix)
    {
        $stack = [];

        foreach ($postfix as $token) {
            if (is_numeric($token)) {
                $stack[] = $token;
            } else {
                $operand2 = array_pop($stack);
                $operand1 = array_pop($stack);

                switch ($token) {
                    case '+':
                        $stack[] = $operand1 + $operand2;
                        break;
                    case '-':
                        $stack[] = $operand1 - $operand2;
                        break;
                    case '*':
                        $stack[] = $operand1 * $operand2;
                        break;
                    case '/':
                        if ($operand2 != 0) {
                            $stack[] = $operand1 / $operand2;
                        } else {
                            throw new \Exception("Division by zero");
                        }
                        break;
                    default:
                        throw new \Exception("Invalid operator: $token");
                }
            }
        }

        if (count($stack) !== 1) {
            throw new \Exception("Invalid expression");
        }

        return reset($stack);
    }

    protected function getPrecedence($operator)
    {
        switch ($operator) {
            case '+':
            case '-':
                return 1;
            case '*':
            case '/':
                return 2;
            default:
                return 0;
        }
    }
}
