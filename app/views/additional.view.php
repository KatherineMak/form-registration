<div class="container">
    <div class="row">
        <div class="card col-sm-8 form-card">
            <div class="card-body">

                <h3 class="card-title">To participate in the conference, please fill out the form</h3>

                <form class="needs-validation" novalidate method="post" id="form2" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="InputCompany">Company</label>
                        <input type="text" class="form-control" name="additionalForm[company]" placeholder="Enter company">
                    </div>

                    <div class="form-group">
                        <label for="InputPosition">Position</label>
                        <input type="text" class="form-control" name="additionalForm[position]" placeholder="Enter position">
                    </div>

                    <div class="form-group">
                        <label for="InputAboutMe">About Me</label>
                        <textarea class="form-control" name="additionalForm[aboutMe]" rows="3" placeholder="Write something about you"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="InputAboutMe">Photo (max size 2Mb)</label>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="upload" name="photo" accept=".jpg, .jpeg, .png">
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            <div class="invalid-feedback">Invalid file size.</div>
                        </div>
                    </div>
                    <div id="no-validate-photo" style="display:none; color:#61ff51"></div>
                    <a href="/index" class="btn btn-secondary active" role="button" aria-pressed="true">Back</a>
                    <button onclick="ajaxForm.saveAdditionalForm(event)" type="submit" id="btn_1" class="btn btn-info">Next</button>
                </form>

            </div>

        </div>
    </div>
</div>