<?php
$ac = "dashboard";
?>
@extends('dashboard_layout')

@section('dashboard-title',"Dashboard")

@section('dashboard-content')
  @if(count($notifications) > 0)
  <div class="row">
        <div class="col-md-12">
         @foreach($notifications as $n)
          @include('components.dashboard-notification',[
            'type' => $n['type'],
            'content' => isset($n['content']) ? $n['content'] : "",
            'xf' => $n['id']
            ])
         @endforeach
        </div>
  </div>
  @endif

  <div class="row">
    <div class="col-lg-6 col-md-12">
    <div class="utf_dashboard_list_box with-icons margin-top-20">
      <h4>Recent Updates</h4>
      <ul>
        <?php
         if(count($notifications) > 0)
         {
           foreach($notifications as $ru){
        ?>
         @include('components.recent-updates-widget',$ru)
        <?php
         }
        }
        else
        {
        ?>
         <li><i class="utf_list_box_icon sl sl-icon-eyeglass"></i> No new updates yet. </strong>
      </li>
        <?php
        }
       ?>
      
      </ul>
    </div>
       
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="utf_dashboard_list_box invoices with-icons margin-top-20">
            <h4>All Applications</h4>
            <ul>
        <?php
         if(count($schoolApplications) > 0)
         {
         foreach($schoolApplications as $sa)
         {
          $iid = "shdj3";
          $iu = url('application-invoice')."?xf=".$iid;
          $u = $sa['user'];
          $a = $sa['admission'];
          $term = ['name' => "", 'value' => '0'];

          foreach($terms as $t)
                    {
                      if($t['value'] === $a['term_id']) $term = $t;
                    }
        ?>
      <li><i class="utf_list_box_icon sl sl-icon-doc"></i> <strong>{{$a['session']}} <span
          class="paid">{{ucwords($sa['stage'])}}</span></strong>
        <ul>
        <li>
          <p>
            <span>Applicant:-</span> {{$u['fname']}} {{$u['lname']}}<br>
            <span>Term selected:-</span> {{$term['name']}}
          </p>
        </li>
        </ul>
        <div class="buttons-to-right"> <a href="{{$iu}}" target="_blank" class="button gray"><i
          class="sl sl-icon-printer"></i> Invoice</a> </div>
      </li>
       <?php
         }
        }
        else
        {
        ?>
         <li><i class="utf_list_box_icon sl sl-icon-eyeglass"></i> No applications yet. <a href="{{url('school-admissions')}}">View admissions</a></strong>
      </li>
        <?php
        }
       ?>
      </ul>
        </div>
    </div>
</div>
@stop