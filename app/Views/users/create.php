<?php include(__DIR__ . '/../include/header.php'); ?>
    <!-- Main Container -->
    <div class="container">

        <?php include(__DIR__ .'/../include/sidebar.php'); ?>


        <!-- Main Content -->
        <main class="main-content">
            <div class="users-header">
                <h1>Add New User</h1>
                <div class="header-actions">
                    <a href="<?= base_url('users') ?>" class="back-btn">
                        <i class="material-icons">arrow_back</i>
                        <span>Back to Users</span>
                    </a>
                </div>
            </div>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="success-message">
                    <i class="material-icons">check_circle</i>
                    <span><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>

            <?php if(isset($validation)): ?>
                <div class="error-messages">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>

            <div class="form-container">
                <form method="post" action="<?= base_url('users/store') ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" name="name" id="name" value="<?= old('name') ?>" placeholder="Enter full name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" name="email" id="email" value="<?= old('email') ?>" placeholder="Enter email address" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <div class="password-input">
                            <input type="password" name="password" id="password" placeholder="Enter password" required>
                            <button type="button" class="toggle-password" onclick="togglePasswordVisibility()">
                                <i class="material-icons" id="toggleIcon">visibility</i>
                            </button>
                        </div>
                        <small class="form-help">Minimum 6 characters</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password *</label>
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="profile_image">Profile Image</label>
                        <div class="file-upload-area">
                            <div class="upload-placeholder" id="uploadPlaceholder">
                                <i class="material-icons">cloud_upload</i>
                                <p>Drag & drop or click to upload</p>
                                <span>Max size: 2MB</span>
                            </div>
                            <input type="file" name="profile_image" id="profile_image" accept="image/*" class="file-input">
                            <div class="image-preview" id="imagePreview"></div>
                        </div>
                        <small class="form-help">Allowed: JPG, PNG, GIF. Recommended: 200x200px</small>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="submit-btn">
                            <i class="material-icons">person_add</i>
                            <span>Create User</span>
                        </button>
                        <button type="reset" class="reset-btn">
                            <i class="material-icons">refresh</i>
                            <span>Reset Form</span>
                        </button>
                        <a href="<?= base_url('users') ?>" class="cancel-btn">
                            <i class="material-icons">cancel</i>
                            <span>Cancel</span>
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>



<?php include(__DIR__ . '/../include/footer.php'); ?>