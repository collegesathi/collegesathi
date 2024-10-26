<section class="faq-section my-5">
    <div class="container">
        <div class="header">
            <h2>FAQ: Get the Information You Need</h2>
        </div>
        <div class="body mt-4">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button faq-acc" type="button">
                            <span>⭐</span>
                            <b class="ms-5">What is Collegesathi?</b>
                        </button>
                    </h2>
                    <div class="accordion-collapse collapse faq-collapse">
                        <div class="accordion-body">
                        <strong>Collegesathi is a platform where individuals can compare 100+ online universities and find the best online program with the help of expert counsellors.</strong>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button faq-acc" type="button">
                            <span>⭐</span>
                            <b class="ms-5">Do Collegesathi charge for counselling? </b>
                        </button>
                    </h2>
                    <div class="accordion-collapse collapse faq-collapse">
                        <div class="accordion-body">
                            <strong>No, Collegesathi provides free counselling to students to help them choose the best university. Collegesathi is dedicated to providing educational solutions to the maximum number of students and working professionals.</strong>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button faq-acc" type="button">
                            <span>⭐</span>
                            <b class="ms-5"> How can Collegesathi help me to apply to the best university?</b>
                        </button>
                    </h2>
                    <div class="accordion-collapse collapse faq-collapse">
                        <div class="accordion-body">
                            <strong>Collegesathi’s experts will provide you with counselling to help you choose the best university according to your priorities and discover the most affordable university.</strong>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button faq-acc" type="button">
                            <span>⭐</span>
                            <b class="ms-5">How can I compare multiple programs at once?</b>
                        </button>
                    </h2>
                    <div class="accordion-collapse collapse faq-collapse">
                        <div class="accordion-body">
                            <strong>Collegesathi’s expert professionals will help you assess your career goals and objectives. Based on this information, the counselling experts will guide you in selecting a program to help you achieve your aspirations.</strong> 
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button faq-acc" type="button">
                            <span>⭐</span>
                            <b class="ms-5">Can I get personalized advice from Collegesathi?</b>
                        </button>
                    </h2>
                    <div class="accordion-collapse collapse faq-collapse">
                        <div class="accordion-body">
                            <strong>Yes, the counsellors will analyse your priorities and goals and find you the best program and university. The experts will also help you find the best program within your budget.</strong> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <style>

.accordion-button {
    position: relative;
    padding-right: 40px; 
    background: #F8F9FB !important;
    border: none !important;
}

.accordion-button::before {
    content: "+"; 
    position: absolute;
    right: 36px;
    font-size: 20px;
    transition: transform 0.2s ease; 

    border-radius: 50%; 
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    right: 20px;
    background: #F8F2F2;
    color: #ED2C32;
}


.accordion-button::after {
    background-image: none !important;
}

.accordion-button.active::before {
    content: "×"; 
    background: #ED2C32;
    color: white;
    border-radius: 50%;
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    right: 20px;
}

</style>
<script>
    $(document).ready(function() {
        $('.faq-acc').click(function() {
            var $this = $(this);
            var $accordionCollapse = $this.parent().next('.faq-collapse');

            // Toggle the collapse class for the clicked item's body
            $accordionCollapse.toggleClass('show');

            // Remove show class from all others (to close other open answers)
            $('.faq-collapse').not($accordionCollapse).removeClass('show');

            // Toggle active class for the clicked button
            $this.toggleClass('active');

            // Remove active class from other buttons
            $('.faq-acc').not($this).removeClass('active');
        });
    });
</script>
