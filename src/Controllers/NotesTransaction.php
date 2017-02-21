<?php

namespace CashMachine\Controllers;

use InvalidArgumentException;
use CashMachine\Exceptions\NoteUnavailableException;

class NotesTransaction
{
    private $availableNotes = [10.00, 20.00, 50.00, 100.00];

    /**
     * @param null $amount
     * @return array|void
     */
    public function get($amount = null)
    {
        if (empty($amount)) {
            return ['notes' => []];
        }

        $this->validate($amount);

        return $this->process($amount);
    }

    /**
     * @param $amount
     * @return bool
     */
    public function validate($amount)
    {
        // as php has max int so we can add  || $amount > PHP_INT_MAX
        if ( ! is_numeric($amount) || $amount < 0) {
            throw new InvalidArgumentException('Required amount is not valid');
        }

        if ((floor( $amount ) != $amount) || ($amount % min($this->availableNotes) > 0)){
            throw new NoteUnavailableException('Notes are unavailable for the required amount');
        }

        return true;
    }

    /**
     * @param $amount
     * @return array
     */
    public function process($amount)
    {
        asort($this->availableNotes);
        $result = [];

        for ($i = sizeof($this->availableNotes)-1; $i >= 0; $i--) {
            // Find denominations
            while ($amount >= (int)$this->availableNotes[$i])
            {
                $amount -= $this->availableNotes[$i];
                $result[] = $this->availableNotes[$i];
            }
        }

        return ['notes' => $result];
    }
}