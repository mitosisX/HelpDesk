<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/modal-fx.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/bulma-radio-checkbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/bulma-badge.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/bulmatable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/extensions/bulma-calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/simple-tags.css') }}">
    @yield('title')
</head>
<body>
    <section class="hero is-info">
        <div class="hero-body">
            <p class="title">
            Nothern Region Water Board (NRWB)
            </p>
            <p class="subtitle">
            Help desk system
            </p>
        </div>
    </section>
    
    <div class="columns my-1 mx-2">
        <div class="column box is-2">
            
        <!-- START SIDE MENU -->
            <aside class="menu">
                <p class="menu-label">
                  General
                </p>
                <ul class="menu-list">
                  <li><a>Dashboard</a></li>
                  <li><a>Profile</a></li>
                </ul>
                <p class="menu-label">
                  Tickets
                </p>
                <ul class="menu-list">
                  <!-- <li><a>Team Settings</a></li> -->
                  <li>
                    <a class="is-active has-background-info">Statistics</a>
                    <ul>
                      <li><a>Active</a></li>
                      <li><a>Open</a></li>
                      <li><a>Closed</a></li>
                      <li><a>Overdue</a></li>
                    </ul>
                  </li>
                  <li><a>Invitations</a></li>
                  <li><a>Cloud Storage Environment Settings</a></li>
                  <li><a>Authentication</a></li>
                </ul>
                <p class="menu-label">
                  Transactions
                </p>
                <ul class="menu-list">
                  <li><a>Payments</a></li>
                  <li><a>Transfers</a></li>
                  <li><a>Balance</a></li>
                </ul>
              </aside>
        </div>
        <!-- END SIDE MENU -->
        @yield('content')
    </div>


    
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bulma-tagsinput.min.js') }}"></script>
    <script src="{{ asset('js/bulma-calendar.min.js') }}"></script>
    <script src="{{ asset('js/modal-fx.min.js') }}"></script>
    <script src="{{ asset('js/simple-tags.js') }}"></script>
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
</body>
</html>