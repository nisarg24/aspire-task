<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Http\Traits\ResponseTrait;
use App\Http\Requests\LoanRequest;

class LoanController extends Controller
{
    use ResponseTrait;

    public function create(LoanRequest $request)
    {
        try {
            $loan = Loan::orderBy('id', 'desc')->first();
            $data['user_id'] = \Auth::user()->id;
            $data['code'] = generateCode($loan);
            $data['amount'] = $request->amount;
            $data['term'] = $request->term;
            $data['is_month'] = $request->is_month ? 1 : 0;
            $data['start_date'] = $request->start_date;
            $data['end_date'] = calculateLoanEndDate($request)->format('Y-m-d');

            $loanData = Loan::create($data);

            return $this->success(
                'Loan successfully applied. Please wait for the approval',
                $loanData
            );
        } catch(\Exception $e) {
            return $this->error(
                403,
                $e->getMessage()
            );
        }
        
    }

    public function approve(Request $request)
    {
        \DB::beginTransaction();
        try {
            $isAdmin = \Auth::user()->is_admin;

            if (!$isAdmin) {
                return $this->error(
                    403,
                    'Only admin can approve the loan'
                );
            }

            $loanId = $request->loan_id;
            
            $loan = Loan::find($loanId);
            $loan->is_approved = 1;
            $loan->save();

            $emiData = $this->generateEmi($loan);

            \App\Models\Emi::insert($emiData);
            \DB::commit();
            return $this->success(
                'Loan successfully approved',
                $loan
            );
        } catch(\Exception $e) {
            \DB::rollBack();
            return $this->error(
                403,
                $e->getMessage()
            );
        }
        
    }

    private function generateEmi($loan)
    {
        $emiData = calculateWeeklyPrice($loan);
        $i = 0;
        foreach ($emiData as $week => $emi) {
            $data[$i]['user_id'] = $loan->user_id;    
            $data[$i]['loan_id'] = $loan->id;    
            $data[$i]['amount'] = $emi['payment_price'];    
            $data[$i]['payment_date'] = $emi['payment_date'];
            $i++;
        }

        return $data;
    }

    public function index(Request $request)
    {
        try {
            $userId = \Auth::user()->id;
            $loan = Loan::where('user_id', $userId)
                ->with('emis')
                ->get();
            return $this->success(
                'Loan and its emi',
                $loan
            );
        } catch (\Exception $e) {
            return $this->error(
                403,
                $e->getMessage()
            );
        }
    }
}
