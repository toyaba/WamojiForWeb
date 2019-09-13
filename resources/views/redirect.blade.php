    <script>
      var timeout_id = null;

      var startTimeout = function() {
        timeout_id = setTimeout("location.href='{{$url}}'",1000*60*{{$redirect_time}});
      }

      var resetTimeout = function() {
        if(timeout_id !== null) {
          clearimeout(timeout_id);
          timeout_id = null;
          startTimeout();
        }
      }

      startTimeout();
    </script>
