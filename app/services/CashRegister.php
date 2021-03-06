<?php
namespace App\Services;


use App\Order;
use Money\Currency;
use Money\Money;

/**
 * Created by PhpStorm.
 * User: mickeyschwab
 * Date: 2/3/17
 * Time: 6:04 PM
 */
class CashRegister
{
    /**
     * @param Order $order
     * @return Money
     */
    public function getTransactionTotal(Order $order)
    {
        $transactions = $order->transactions()->where('status', 'COMPLETE')->get();
        $total = $transactions->sum('amount');
        $amount = new Money($total, new Currency('USD'));
        return $amount;
    }
	
	/**
	* @param Order $order
	* @return Money
	*/
    public function getProductTotal(Order $order)
    {
		$products = $order->products()->get();
		$total = 0;
		foreach($products as $item){
			$total+=$item->amount *$item->quantity;
		};
        $amount = new Money($total, new Currency('USD'));
		return $amount;
		
    }
}