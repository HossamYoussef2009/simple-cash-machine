<?php

namespace CashMachine\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use CashMachine\Exceptions\NoteUnavailableException;
use \InvalidArgumentException;


class CashWithdraw extends ApiController
{
    /**
     * CashWithdraw constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createTransaction(Request $request)
    {
        $amount = $request->get('amount');

        try{
            $notesTransaction = new NotesTransaction();

            $result = $notesTransaction->get($amount);

            return $this->apiResponse($result);

        } catch (InvalidArgumentException $e) {

            return $this->InvalidArgumentResponse($e->getMessage());
        } catch (NoteUnavailableException $e) {

            return $this->unavailableResponse($e->getMessage());
        }
    }
}