 
 // Javascript to portray the Slideshow
    // Global variable of current position in Slideshow
    var curSlide = 1;

    // Global Variable of Number of Slides
    var allSlides = document.getElementsByClassName("slide").length;

    // portray first Slide on load of Side
    showSlide(curSlide);


    // portray a Slide by number
    function showSlide(numSlide) {
        let loopVar;

        // get all Slides and put them in array "slides"
        let slides = document.getElementsByClassName("slide");

        // if the number given is higher than there are available slides, set Slide to portray to 1
        if (numSlide > allSlides) {
            numSlide = 1;
        }

        //if the number given isbelow zero, set Slide to portray to the last one
        if (numSlide < 1) {
            numSlide = allSlides;
        }

        //set all Slides invisible one by one
        for (loopVar=0;loopVar<allSlides;loopVar++) {
            slides[loopVar].style.display = "none";
        }

        //view the needed Slide
        slides[numSlide-1].style.display="block";

        //set Global Variable
        curSlide = numSlide;

    }

    function showPrevSlide(){
            showSlide(curSlide-1);
    }

    function showNextSlide(){
        showSlide(curSlide+1);
    }

        //change slides all 3 seconds
    window.setInterval(showNextSlide(), 4000);
