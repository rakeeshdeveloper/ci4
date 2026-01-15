<?php include(__DIR__ . '/../include/header.php'); ?>
    <!-- Main Container -->
    <div class="container">

        <?php include(__DIR__ .'/../include/sidebar.php'); ?>

        <!-- Main Content -->
        <main class="main-content">
            <div class="users-header">
                <h1>Edit User</h1>
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
                <form method="post" action="<?= base_url('users/update/' . $user['id']) ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" value="<?= old('name', $user['name'] ?? '') ?>" placeholder="Enter full name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" value="<?= old('email', $user['email'] ?? '') ?>" placeholder="Enter email address" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password (Leave blank to keep current)</label>
                        <input type="password" name="password" id="password" placeholder="Enter new password">
                        <small class="form-help">Minimum 6 characters</small>
                    </div>
                    
                    <div class="form-group">
                        <label>Current Profile Image</label>
                        <div class="current-image">
                            <?php if($user['profile_image']): ?>
                                <img src="<?= base_url('uploads/' . $user['profile_image']) ?>" alt="Current profile image">
                            <?php else: ?>
                                <div class="no-image">
                                    <i class="material-icons">person</i>
                                    <span>No profile image</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="profile_image">Change Profile Image</label>
                        <div class="file-upload">
                            <input type="file" name="profile_image" id="profile_image" accept="image/*">
                            <label for="profile_image" class="file-upload-label">
                                <i class="material-icons">cloud_upload</i>
                                <span>Choose new image</span>
                            </label>
                        </div>
                        <small class="form-help">Max size: 2MB, Allowed: JPG, PNG, GIF</small>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="submit-btn">
                            <i class="material-icons">save</i>
                            <span>Update User</span>
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