<div class="row col-md-12" id="dashboard">
    <div class="column col-md-3 dashboard_links" style="padding:0px;">

    </div>
    <div class="row col-md-12" style="display:flex; align-items:center; text-align:center;">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <style>
            .mySlides {display:none;}
        </style>
        <body>

        <h2 class="w3-center"></h2>

        <div class="w3-content w3-display-container">
            <img class="mySlides" src="images/floor/0.jpg" style="width:100%">
            <img class="mySlides" src="images/floor/1.jpg" style="width:100%">
            <img class="mySlides" src="images/floor/2.jpg" style="width:100%">
            <img class="mySlides" src="images/floor/3.jpg" style="width:100%">
            <img class="mySlides" src="images/floor/4.jpg" style="width:100%">
            <img class="mySlides" src="images/floor/5.jpg" style="width:100%">

            <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
            <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
        </div>

        <script>
            var slideIndex = 1;
            showDivs(slideIndex);

            function plusDivs(n) {
                showDivs(slideIndex += n);
            }

            function showDivs(n) {
                var i;
                var x = document.getElementsByClassName("mySlides");
                if (n > x.length) {slideIndex = 1}
                if (n < 1) {slideIndex = x.length}
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                x[slideIndex-1].style.display = "block";
            }
        </script>

        </body>
    </div>
</div>


<style>

    #dashboard{
        border-color:#22313f;
        border-radius:5px;
        border-style:solid;
        border-width:2px;
        //box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        padding:0px;
    }

    .dashboard_links{
        background-color:#22313f;
    }

    .dashboard_links a{
        text-decoration:none;
    }

    .dashboard_link{
        padding:20px;
        background-color:#22313f;
        color:white;
        text-transform:uppercase;
        font-size:18px;
        transition:all 0.2s;
        cursor:pointer;
    }

    .dashboard_link:hover{
        background-color: #364e64;
    }
</style>