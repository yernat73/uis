@extends('layouts.student')

@section('content')
    <div class="container">
       
        <h1 class="display-4">GPA Counter</h1>
        <hr>
        {{ Breadcrumbs::render('gpa') }}
        <div class="container">
            <table class="table table-hover box-shadow">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Course Name</th>
                        
                        <th scope="col">Credits</th>
                        
                        <th scope="col">Grade</th>
                        
                        <th scope="col">EKV</th>
                        
                        <th scope="col">LTR</th>
                    </tr>
                </thead>
                <tbody>
    
                    <?php
                        $credits = 0;
                        $gpa = 0.0;
                        ?>
                    @foreach($courses as $c)
                    <tr>
                        <td>{{$c->name}}</td>
                        <td>{{$c->credits}}</td>
                        <?php
                            $total = 0.0;
                        ?>
                        @foreach($c->lessons as $l)
                            @if($l->status == 1)
                                @foreach($l->marks as $m)
                                    @if($m->user_id == Auth::user()->id)
                                        <?php
                                        $total += $m->value * ($l->percentage / 100);
                                        ?>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        <td>{{$total}}</td>
                        <?php
                        $ekv = 0.0;
                        $ltr = "";
                        if($total >= 95 && $total <= 100){
                            $ekv = 4;
                            $ltr = 'A';
                        }else if($total >=90){
                            $ekv = 3.7;
                            $ltr = 'A-';
                        }else if($total >=85){
                            $ekv = 3.3;
                            $ltr = 'B+';
                        }else if($total >=80){
                            $ekv = 3;
                            $ltr = 'B';
                        }else if($total >=75){
                            $ekv = 2.7;
                            $ltr = 'B-';
                        }else if($total >=70){
                            $ekv = 2.3;
                            $ltr = 'C+';                        
                        }else if($total >=65){
                            $ekv = 2;
                            $ltr = 'C';
                        }else if($total >=60){
                            $ekv = 1.7;
                            $ltr = 'C-';
                        }else if($total >=55){
                            $ekv = 1.3;
                            $ltr = 'D+';
                        }else if($total >=50){
                            $ekv = 1;
                            $ltr = 'D';
                        }else{
                            $ekv = 0;
                            $ltr = 'F';
                        }
                        $gpa += $ekv* $c->credits;
                        $credits += $c->credits;
                        ?>
    
                        <td>{{$ekv}}</td><?php ?>
                        <td>{{$ltr}}</td>
                        
                    </tr>
    
                    @endforeach
                    <?php
                        $gpa /= $credits;
                    ?>
                </tbody>
            </table>
<style>
    .wg-result-wrapper {
        padding: 0;
        text-align: center;
    }
    .sidebar.sidebar-score {
        width: 155px;
        margin: 0 auto;
        border-left: none;
        left: -6px;
        padding: 0;
    }
    .score-circle {
        box-sizing: content-box;
        border: 6px solid white;
        border-radius: 200px;
        height: 145px;
        width: 145px;
        overflow: hidden;
    }
    .score-outer {
        transition: 1s;
        color: #FFF;
        display: table;
        vertical-align: middle;
        text-align: center;
        width: 145px;
        height: 145px;
        margin: 0px;
    }
    .score-inner {
        display: table-cell;
        vertical-align: middle;
    }
    span {
        display: inline-block;
        font-weight: 400;
        line-height: 1;
    }
    .your-title {
        line-height: 1.1;
        font-size: 16px;
        width: 80%;
    }
    
    .score {
        font-weight: 700;
        font-size: 50px;
    }
            
</style>
<?php
    $color = "";
    if($gpa > 3.4){
        $color = 'success';
    }else if($gpa > 2.4){
        $color = 'warning';
    }else{
        $color = 'danger';
    }
    
?>

            <div class="wg-result-wrapper">
                <div class="sidebar sidebar-score">
                    <div class="score-circle box-shadow">
                        <h4 class="score-outer bg-{{$color}}">
                            <span class="score-inner">
                                <span class="your-title">Your Overall GPA is</span>
                                <span class="score">{{number_format($gpa, 2)}}</span>
                            
                            </span>
                        </h4>
                    </div>
                </div>
            
            </div>
        </div>
        
        
    </div>
@endsection