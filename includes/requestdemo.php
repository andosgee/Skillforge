<div id="request" class="content">
<h1 class="content__h1">Request a Demo</h1>
    <div class="content__text">
    Are you curious about how Skillforge can revolutionize learning 
    and streamline operations for you or your organization? <br>
    Requesting a personalized demo today opens the door to a 
    world of possibilities. Our dedicated team is ready to guide you 
    through a comprehensive tour of our platform's robust features 
    and versatile capabilities. Whether you're seeking to enhance 
    individual skill sets or optimize team efficiency, we're here to
     tailor the demo experience precisely to your unique needs and 
     requirements. Let us illuminate the path to success together.

        <h2 class="content__h2">Why Request a Demo?</h2>
        <ul>
            <li>
                <b>Personalised Guidance:</b> Our demos are customized to 
                address your unique challenges and goals. Get 
                personalized insights on how Skillforge can help you 
                achieve success.
            </li>
            <li>
                <b>Live Demonstration:</b> Experience our platform firsthand 
                with a live demonstration led by one of our knowledgeable 
                team members. See how easy it is to navigate through our 
                courses and SOP tools.
            </li>
            <li>
                <b>Q&A Session:</b> Have questions? We're here to provide 
                answers. Take advantage of the opportunity to ask our 
                experts anything about Skillforge and how it can support 
                your learning and operational needs.
            </li>
        </ul>
        
        <h2 class="content__h2">How to Request a Demo</h2>
        To request a demo, simply fill out the form below with your 
        contact information and any specific details you'd like us to
         cover during the demo. Once we receive your request, a member of our team will reach out to schedule a convenient time for your personalized demo session.
    </div>
    <form action="" class="form">
        <fieldset class="form__fieldset">
            <legend class="form__legend">Contact Details for Demo</legend>
            <label for="firstName" class="form__label">First Name:</label>
            <input type="text" name="firstName" class="form__textInput" placeholder="Bob">
            <br>
            <label for="lastName" class="form__label">Last Name:</label>
            <input type="text" name="lastName" class="form__textInput" placeholder="Smith">
            <br>
            <label for="email" class="form__label">Email:</label>
            <input type="email" name="email" class="form__emailInput" placeholder="bob.smith@example.com">
            <br>
            <label for="contactPhone" class="form__label">Contact Nmber:</label>
            <input type="tel" name="contactPhone" class="form__telInput" placeholder="64111111111">
            <br>
            <label for="company" class="form__label">Company:</label>
            <input type="text" name="company" class="form__textInput" placeholder="Bob Indsutries Inc.">
            <br>
            <label for="countrySelect" class="form__label">Country:</label>
            <select name="countrySelect" id="countries" data-palceholder="Select Country" class="form__select">
                <?php 
                    include "countryList.php";
                ?>
            </select>
            <br>
            <input type="submit" value="Request" class="form__submitInput">
        </fieldset>
    </form>
    <script src="./chosenLib/chosen.jquery.js" type="text/javascript"></script>
    <script>
        $("#countries").chosen({no_results_text: "Oops, nothing found!"});
    </script>
</div>