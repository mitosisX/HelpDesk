@extends('staff.layout.app')

@section('title')
    <title>All Ticket - Admin</title>
@endsection

@section('content')
  <!-- START ISSUES LIST-->
    <div class="column">
        <div class="column box">
          <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-start">
              <h1 class="title is-size-3 has-text-info">Create ticket</h1>
            </div>
            <div class="navbar-end">
              <div class="tags has-addons">
                <span class="tag is-size-6 is-rounded">Ticket number</span>
                <span class="tag is-info is-size-6 is-rounded">{{ $ticketNumber }}</span>
              </div>
            </div>
          </nav>
        </div>

        <section class="section" style="padding: 1.5rem;margin-top:-25px;">
          <div class="column box is-multiline is-8">

            
            
          </div>
        </section>
    </div>
  <!-- END ISSUES LIST -->
@endsection

@section('script')
  <script>

    $(document).ready(function(){
      

    const calendar = bulmaCalendar.attach("#duedate");

    // To access to bulmaCalendar instance of an element
    const element = document.querySelector('#duedate');
    const today = new Date();

    if (element) {
      // bulmaCalendar instance is available as element.bulmaCalendar
      element.bulmaCalendar.on('select', datepicker => {
        console.log(showDiff(today, new Date(datepicker.data.value())));
      });
    }
    });


    function showDiff(date1, date2)
    {   
        var diffObj = dateDiff(date1,date2);
        var s = diffObj.sign;
        if(diffObj.years > 0) s += diffObj.years+" years, "
        if(diffObj.months > 0) s += diffObj.months+" months, "
            s += diffObj.days + " days"//+diffObj.days>11?'s':''

        if(s.charAt(0) == '-' && s.charAt(1) !== '0')
        {
          $('#datediff').text('before today');
          $('#submit').attr('disabled', true);
        }
        else if(s.charAt(0) == '-' && s.charAt(1) == '0'){
          $('#datediff').text('today');
          $('#submit').attr('disabled', false);
        }
        else if(s.charAt(0) == '1' && s.charAt(1) == ' '){
          $('#datediff').text('tomorrow');
          $('#submit').attr('disabled', false);
        }
        else{
          $('#datediff').text(s);
          $('#submit').attr('disabled', false);
        }

        console.log(s)
    }

    function dateDiff(dt1, dt2)
    {
        // setup return object
        var ret = {days:0, months:0, years:0,sign:""};

        // if same date, nothing to do
        if (dt1 == dt2) return ret;

        // we will do absolute diff and set the sign
        if (dt1 > dt2)
        {
            var dtmp = dt2;
            dt2 = dt1;
            dt1 = dtmp;
            ret.sign = "-";
        }
    
        // populate variables for comparison
        var year1 = dt1.getFullYear();
        var year2 = dt2.getFullYear();

        var month1 = dt1.getMonth();
        var month2 = dt2.getMonth();

        var day1 = dt1.getDate();
        var day2 = dt2.getDate();

        // calculate differences
        ret.years = year2 - year1;
        ret.months = month2 - month1;
        ret.days = day2 - day1;
    
        // cope with any negative values.
        if (ret.days < 0)
        {
            // can't span months by arithmetic, use temp date
            var dtmp = new Date(dt1.getFullYear(), dt1.getMonth() + 1, 1, 0, 0, -1);
            var numDays = dtmp.getDate();
    
            ret.months -= 1;
            ret.days += numDays;
        }
    
        // months is pure arithmetic
        if (ret.months < 0)
        {
            ret.months += 12;
            ret.years -= 1;
        }

        return ret;
    }
  </script>
@endsection