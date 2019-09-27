<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;
use Carbon\Carbon;
use Overtrue\ChineseCalendar\Calendar;

class Index extends BaseController
{
    public function index()
    {
       return View::fetch();
    }

    public function timestamp()
    {
        return View::fetch();
    }

    public function shorturl() {
        return View::fetch();
    }

    public function md5() {
        return View::fetch();
    }

    public function age($year=2000, $month = 10, $day = 10, $hour = 0) {

        $birthday = $year . '-' . $month . '-' . $day;

        $calendar = new Calendar();

        $date = $calendar->solar($year, $month, $day, $hour);
        $live_month = Carbon::parse($birthday)->diffInMonths();
        $age = Carbon::parse($birthday)->diffInYears();

        $last_month = 900 - $live_month;
        $last_month = $last_month <= 0 ? '很多' : $last_month;

        View::assign('year', $year);
        View::assign('month', $month);
        View::assign('day', $day);
        View::assign('hour', $hour);
        View::assign('last_month', $last_month);
        View::assign('birthday', $birthday);
        View::assign('live_month', $live_month);
        View::assign('age', $age);
        View::assign('date', $date);
        return View::fetch();
    }
}
