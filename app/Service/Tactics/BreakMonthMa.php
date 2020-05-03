<?php

/**
 * 突破月線
 */

namespace App\Service\Tactics;

class BreakMonthMa extends Base
{
    /**
     * 突破月線
     */
    const BREAK_MONTH_MA = 'break_month_ma';

    /**
     * 突破月線且投信買超
     */
    const TRUST_BUY_BREAK_MONTH_MA = 'trust_buy_break_month_ma';

    /**
     * 突破月線且外資買超
     */
    const FOREIGN_INVESTMENT_BUY_BREAK_MONTH_MA = 'foreign_investment_buy_break_month_ma';

    /**
     * @return array
     */
    public function name(): array
    {
        return [
            self::BREAK_MONTH_MA,
            self::TRUST_BUY_BREAK_MONTH_MA,
            self::FOREIGN_INVESTMENT_BUY_BREAK_MONTH_MA,
        ];
    }

    /**
     * @return array
     */
    protected function methods(): array
    {
        return [
            $this->ma(),
            $this->tyBuyMa(),
            $this->foBuyMa(),
        ];
    }

    /**
     * 突破月線
     *
     * 1. 今日收盤價大於月均線
     * 2. 昨日收盤價小於等於月均線
     *
     * @return array
     */
    private function ma()
    {
        return [
            'name' => self::BREAK_MONTH_MA,
            'rules' => [
                [
                    [
                        // 今日收盤價大於月均線
                        'where' => 'close',
                        'operator' => '>=',
                        'value' => '20ma',
                    ],
                ],

                [
                    [
                        // 昨日收盤價小於等於月均線
                        'where' => 'close',
                        'operator' => '<',
                        'value' => '20ma',
                    ],
                ],
            ],
        ];
    }

    /**
     * 突破月線且投信買超
     *
     * 1. 突破月線
     * 2. 投信買超大於1張
     *
     * @return array
     */
    private function tyBuyMa()
    {
        return [
            'name' => self::TRUST_BUY_BREAK_MONTH_MA,
            'tactics' => self::BREAK_MONTH_MA,
            'rules' => [
                [
                    [
                        // 投信買超大於1張
                        'where' => 'trust_buy',
                        'operator' => '>',
                        'value' => 1,
                    ],
                ],
            ],
        ];
    }

    /**
     * 突破月線且外資買超
     *
     * 1. 突破月線
     * 2. 外資買超大於1張
     *
     * @return array
     */
    private function foBuyMa()
    {
        return [
            'name' => self::FOREIGN_INVESTMENT_BUY_BREAK_MONTH_MA,
            'tactics' => self::BREAK_MONTH_MA,
            'rules' => [
                [
                    [
                        // 外資買超大於1張
                        'where' => 'foreign_investment_buy',
                        'operator' => '>',
                        'value' => 1,
                    ],
                ],
            ],
        ];
    }
}
