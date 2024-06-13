<div class="content">
    <div class="content__wrapper">
        <div class="module">
            <div class="module__body">
                <div class="module__questions">
                    <ul id="questions">
                        <li>1. Read a PDF</li>
                        <li>2. Answer a Question</li>
                        <li>3. Play a Video</li>
                        <li>Question 4</li>
                        <li>Question 5</li>
                    </ul>
                </div>
                <div id="moduleMain" class="module__main">
                    <!-- Questions will be loaded here dynamically -->
                </div>
            </div>
            <div class="module__buttons">
                <button id="prevButton" class="module__button" disabled>Previous</button>
                <button id="nextButton" class="module__button" disabled>Next</button>
            </div>
            <div class="module__progress">
                Progress: <span id="progressCount">0</span> / 5
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const questions = [
            `<div>
                <p>Read the Following PDF</p>
                <object data="assets/pdfs/example.pdf" type="application/pdf" width="100%" height="500px">
                Your browser does not support PDFs. <a href="assets/pdfs/example.pdf">Download PDF</a> instead.
                </object>
                <label><input type="checkbox" class="question-input"> I have Read</label>
            </div>`,
            `<div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla blandit libero eu mollis facilisis. Donec sit amet porta dolor. Aenean vitae mauris eu leo tempor finibus at vitae quam. Mauris id quam odio. In hac habitasse platea dictumst. Maecenas condimentum tristique placerat. Sed ut risus nec urna imperdiet imperdiet.

Nunc in vehicula odio. Nam vestibulum aliquam leo dignissim feugiat. Pellentesque at consectetur nisl, sit amet tincidunt elit. Nulla sit amet diam id ex vulputate placerat eu vel mi. Nunc dapibus posuere neque, sed luctus lorem lacinia quis. Cras purus risus, porttitor sit amet ullamcorper ac, tempus eu libero. Mauris facilisis tortor turpis, eget dignissim ex scelerisque sollicitudin. Donec ac laoreet dui. Mauris eu augue ullamcorper, dictum leo sed, interdum ex. Nulla eu nisi in ipsum porttitor condimentum vitae vel justo. Vivamus mattis elementum laoreet. Sed eget purus mauris. Cras in leo a mi interdum rhoncus. Donec ut viverra diam. Pellentesque scelerisque fringilla turpis, luctus interdum massa varius lacinia.

Morbi consectetur rutrum aliquam. Sed placerat quis ligula nec tincidunt. Donec volutpat, enim sed pulvinar auctor, lectus lectus egestas odio, eget elementum nulla dolor et risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Cras vel arcu placerat, elementum dui eu, dictum neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas sit amet volutpat leo, eu vestibulum mauris. Cras lobortis dignissim mauris non condimentum. Donec ultrices ac nulla vel aliquam. Donec aliquet velit id neque posuere consequat. Suspendisse sagittis accumsan purus, non viverra dui condimentum eu. Ut ac consectetur nunc.

Quisque porttitor ullamcorper nunc. Curabitur ligula mi, cursus ut ex pulvinar, imperdiet scelerisque lectus. Praesent maximus, quam ut fringilla suscipit, nibh massa imperdiet elit, vitae pharetra libero diam vel sapien. Maecenas porttitor arcu id sapien accumsan scelerisque. Sed eget convallis nibh, ac bibendum nibh. Maecenas tincidunt mauris vel sodales pellentesque. Maecenas maximus libero nisi, ultricies tempus enim lacinia in. Sed lobortis nibh vitae felis consequat vehicula. Phasellus pulvinar mauris ac purus ultricies pellentesque. Cras ac velit quis tellus semper tristique quis eu magna.

Sed a velit leo. Sed viverra erat vitae ligula consectetur fringilla. Integer vel tortor sed arcu viverra ultrices. Cras ac velit in velit placerat malesuada. Suspendisse in diam sit amet augue interdum sollicitudin. Curabitur at risus arcu. Nam sit amet leo sit amet enim rutrum elementum in hendrerit ex. Morbi finibus non orci nec fringilla. Sed interdum turpis efficitur ligula molestie, auctor faucibus dolor hendrerit. Fusce non nulla eget eros ullamcorper bibendum et et ipsum. Integer eget elit nulla. Nullam egestas tincidunt tellus non ultrices.</p>
                <label><input type="checkbox" class="question-input"> Option A</label>
                <label><input type="checkbox" class="question-input"> Option B</label>
                <label><input type="checkbox" class="question-input"> Option C</label>
            </div>`,
            `<div>
            <p>Question 4: Watch the video and select the correct answer</p>
                <video width="600" controls>
                    <source src="assets/video/sample.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <br>
                <label><input type="checkbox" class="question-input"> I have watched the video</label>
            </div>`,
            `<div>
            <p>Question 5: Select the correct answer</p>
                <label><input type="checkbox" class="question-input"> Option X</label>
                <label><input type="checkbox" class="question-input"> Option Y</label>
                <label><input type="checkbox" class="question-input"> Option Z</label>
            </div>`,
            `<div>
                <p>Question 5: Select the correct answer</p>
                <label><input type="checkbox" class="question-input"> Option X</label>
                <label><input type="checkbox" class="question-input"> Option Y</label>
                <label><input type="checkbox" class="question-input"> Option Z</label>
            </div>`
        ];

        const moduleMain = document.getElementById('moduleMain');
        const nextButton = document.getElementById('nextButton');
        const prevButton = document.getElementById('prevButton');
        const progressCount = document.getElementById('progressCount');
        let currentIndex = 0;

        if (!moduleMain || !nextButton || !prevButton || !progressCount) {
            console.error('One or more elements are missing from the DOM.');
            return;
        }

        const loadQuestion = (index) => {
            moduleMain.innerHTML = questions[index];
            const inputs = moduleMain.querySelectorAll('.question-input');
            nextButton.disabled = !Array.from(inputs).some(input => input.checked);
            inputs.forEach(input => input.addEventListener('change', updateNextButton));
            prevButton.disabled = index === 0;
        };

        const updateNextButton = () => {
            const inputs = moduleMain.querySelectorAll('.question-input');
            nextButton.disabled = !Array.from(inputs).some(input => input.checked);
        };

        nextButton.addEventListener('click', () => {
            if (currentIndex < questions.length - 1) {
                currentIndex++;
                loadQuestion(currentIndex);
                progressCount.textContent = currentIndex + 1;
            }
        });

        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                loadQuestion(currentIndex);
                progressCount.textContent = currentIndex + 1;
            }
        });

        loadQuestion(currentIndex);
    });
</script>
