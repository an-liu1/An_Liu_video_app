(()=> {
    const vm = new Vue({
        el: '#app',

        data: {
            mainmessage : "welcome to my video app!",
            videodata : [],
            singlemoviedata : [],

            videosyn: "",
            imageSource: "",
            videotitle : "",
            videosource : "",
            videodescription : "",
            showDetails : false,
            openLightbox: false
        },

        created : function() {
            this.fetchMovieData(null);
        },

        methods : {
            fetchMore(e) {
                this.fetchMovieData(e.currentTarget.dataset.movie); // this will be a number (id)
                imgData = e.currentTarget.getAttribute('href');
                currentData = this.videodata.filter(video => video.thumbnails === imgData);
                this.videosyn = currentData[0].synopsis;
                this.imageSource = currentData[0].thumbnails;
                this.openLightbox = true;
            },

            closeDetails(){
               //debugger;
                this.openLightbox = false;
            },

            loadMovie(e) {
                // stub
                e.preventDefault();

                dataKey = e.currentTarget.getAttribute('href');

                currentData = this.videodata.filter(video => video.vid_path === dataKey);
                console.log(dataKey);
                console.log(currentData);
                this.videotitle = currentData[0].vid_name;
                this.videodescription = currentData[0].vid_desc;
                this.videosource = dataKey;
                //this.videosyn = currentData[0].synopsis;

                this.showDetails = true;

                setTimeout(function() { window.scrollTo(0, 1200); }, 500);
            },

            scrollBackUp() {
                window.scrollTo(0, 0);
                this.showDetails = false;
                this.videsource = "";
            },

            fetchMovieData(movie) {
                url = movie ? `./includes/index.php?movie=${movie}` : './includes/index.php';

                fetch(url) // pass in the one or many query
                .then(res => res.json())
                .then(data => {
                    if (movie) {
                        // getting one movie, so use the single array
                        console.log(data);
                        this.singlemoviedata = data;
                    } else {
                        // push all the video (or portfolio content) into the video array
                        console.log(data);
                        this.videodata = data;
                        
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
            }
        }
    });
})();