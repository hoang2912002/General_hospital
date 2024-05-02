<?php
    if (!function_exists('day')) {
        function day($day){
            //dd($day);
            switch ($day) {
                case 1:
                    return 'Thứ 2';
                    break;
                case 2:
                    return 'Thứ 3';
                    break;
                case 3:
                    return 'Thứ 4';
                    break;
                case 4:
                    return 'Thứ 5';
                    break;
                case 5:
                    return 'Thứ 6';
                    break;
                case 6:
                    return 'Thứ 7';
                    break;
                default:
                    return 'Chủ nhật';
                    break;
            }
            return $day;
        }

    }
