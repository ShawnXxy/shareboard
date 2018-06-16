</div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <script src="js/scripts.js"></script>

    <script type="text/javascript">
        $(function() {
            var prevScroll = 0,
                curDir = 'down',
                prevDir = 'up';

            $(window).scroll(function() {
                if ($(this).scrollTop() >= prevScroll) {
                    curDir = 'up';
                    if (curDir != prevDir) {
                        $('nav').stop();
                        $('nav').animate({
                            top: '-50px'
                        }, 300);
                        prevDir = curDir;
                    }
                } else {
                    curDir = 'down';
                    if (curDir != prevDir) {
                        $('nav').stop();
                        $('nav').animate({
                            top: '0px'
                        }, 300);
                        prevDir = curDir;
                    }
                }
                prevScroll = $(this).scrollTop();
            });
        })
    </script>


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
