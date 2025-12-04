<!-- Header-->
<header class="py-5">
    <div class="container px-5 pb-5">
        <div id="content" class="row gx-5 align-items-center">
            <!-- Left Text Section -->
            <div class="col-xxl-5">
                <div class="text-center text-xxl-start">
                    <div id="keyLine" class="badge bg-gradient-primary-to-secondary text-white mb-4">
                        <div class="text-uppercase"></div>
                    </div>
                    <div id="shortTitle" class="fs-3 fw-light text-muted"></div>
                    <h1 id="mainTitle" class="display-3 fw-bolder mb-5">
                        <span class="text-gradient d-inline"></span>
                    </h1>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-3">
                        <a id="cv2link" target="_blank"
                           class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder"
                           href="{{ url('/resume') }}">Resume</a>
                        <a class="btn btn-outline-dark btn-lg px-5 py-3 fs-6 fw-bolder"
                           href="{{ url('/projects') }}">Projects</a>
                    </div>
                </div>
            </div>

            <!-- Right Image Section -->
            <div class="col-xxl-7">
                <div class="d-flex justify-content-center mt-5 mt-xxl-0">
                    <div class="profile">
                        <!-- Default image from CloudFront -->
                        <img id="profileImage"
                             class="profile-img"
                             src="{{ asset('profile.png') }}"
                             alt="profile" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- JS Script -->
<script>
    const getHero = async () => {
        const loading = document.getElementById("loading-div");
        const content = document.getElementById('content');

        // Show loading spinner and hide content
        if(loading) loading.classList.remove('d-none');
        if(content) content.classList.add('d-none');

        try {
            const response = await axios.get('/heroData');
            const { img, keyLine, title, shortTitle } = response.data;

            // Hide loading spinner and show content
            if(loading) loading.classList.add('d-none');
            if(content) content.classList.remove('d-none');

            // Set Profile Picture with fallback
            const profileImg = document.getElementById('profileImage');
            if(profileImg) {
                profileImg.src = img || 'https://d78worc3m01xi.cloudfront.net/profile.png';
            }

            // Set keyLine
            const keyLineDiv = document.getElementById('keyLine');
            if(keyLineDiv) keyLineDiv.innerText = keyLine || '';

            // Set Short Title
            const shortTitleDiv = document.getElementById('shortTitle');
            if(shortTitleDiv) shortTitleDiv.innerText = shortTitle || '';

            // Set Main Title
            const mainTitleDiv = document.getElementById('mainTitle');
            if(mainTitleDiv) mainTitleDiv.innerText = title || '';

        } catch (error) {
            alert('Something went wrong'); // fixed typo
            console.error(error);
        }
    }

    getHero();
</script>
