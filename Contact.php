<?php include ('header.php') ?>

<div class="container-fluid bg-dark p-3" id="Contact">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 text-white">Contact Us</h1>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
    
    
        <!-- Contact Start -->
        <div class="container-fluid bg-secondary px-0" >
            <div class="row g-0">
                <div class="py-6 mx-auto contact">
                    <h1 class="display-5 mb-4">Contact For Any Queries</h1>
    <form action="mailto:georgemoore2604@gmail.com" method="post" enctype="text/plain">
        <div class="row g-3">
            <div class="col-6">
                <div class="form-floating">
                    <input type="text" class="form-control"  id="form-floating-1" placeholder="John Doe">
                    <label for="form-floating-1">Full Name</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <input type="email" class="form-control"  id="form-floating-2" placeholder="name@example.com">
                    <label for="form-floating-2">Email address</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating">
                    <input type="text" class="form-control"  id="form-floating-3" placeholder="Subject">
                    <label for="form-floating-3">Subject</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control"  placeholder="Message" id="form-floating-4" style="height: 150px"></textarea>
                    <label for="form-floating-4">Message</label>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
            </div>
        </div>
    </form>
                </div>
                          
            </div>
        </div>
<?php include ('footer.php')?>