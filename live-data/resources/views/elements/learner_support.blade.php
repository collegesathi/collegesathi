
@php

$for_roreign_nationals = CustomHelper::getConfigValue('Site.for_roreign_nationals');
$for_indian_nationals = CustomHelper::getConfigValue('Site.for_indian_nationals');

@endphp

<section class="contact-us my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-side">
                        <h2>Collegesathi Learner Support</h2>
                        <p>Have questions or need guidance? Our team is here to help you every step of the way. Reach
                            out for personalized support.</p>
                        <div class="cards-list">
                        <div class="card d-block border-0 py-4 ps-4">
                            <a href="https://wa.me/+919785800008?text=Hello%20there!" target="_blank">
                                <div class="content">
                                    <p class="mb-0"><b>WhatsApp Number</b></p>
                                    <small style="
    color: black;
">Connect with us on WhatsApp</small>
                                </div>
                            </a>
                            <a href="https://wa.me/+919785800008?text=Hello%20there!" target="_blank">
                            <img src="/assets/icons/redwp.png" alt=""></a>

                        </div>
                        <div class="card d-block mt-3 border-0 py-4 ps-4">
    <a href="mailto:support@collegesathi.com">
        <div class="content">
            <p class="mb-0"><b>Send Email</b></p>
            <small style="
    color: black;
">Send us your email</small>
        </div>
        <img src="/assets/icons/redmail.png" alt="Email Icon">
    </a>
</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 contact-card algin-items-center justify-content-center p-4 mt-s-10">
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="First Name">
                            </div>
                            <div class="form-group my-3">
                                <input type="text" class="form-control" placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Mobile Number">
                            </div>
                            <div class="form-group my-3">
                                <textarea class="form-control" rows="5"
                                    placeholder="Write down your query..."></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-red w-100">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<style>
		
.contact-us .left-side {
    max-width: 450px;
}

.contact-us .left-side .card {
    position: relative;
}

.contact-us .left-side .card img {
    position: absolute;
    right: 0;
    bottom: 0;
}

@media (max-width: 800px) {
    .contact-us .left-side {
        max-width: 100%;
    }
}
</style>
