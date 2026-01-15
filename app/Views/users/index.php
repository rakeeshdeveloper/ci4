<<<<<<< HEAD
<?php include(__DIR__ .'/../include/header.php'); ?>
    <!-- Main Container -->
    <div class="container">
       
        <?php include(__DIR__ .'/../include/sidebar.php'); ?>

        <!-- Main Content -->
        <main class="main-content">
            <div class="users-header">
                <h1>Users Management</h1>
                <div class="header-actions">
                    <a href="/users/create" class="add-user-btn">
                        <i class="material-icons">person_add</i>
                        <span>Add New User</span>
                    </a>
                </div>
            </div>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="success-message">
                    <i class="material-icons">check_circle</i>
                    <span><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>

            <div class="users-table-container">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Profile Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td>#<?= $user['id'] ?></td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar-small">
                                        <?php if($user['profile_image']): ?>
                                            <img src="<?= base_url('uploads/'.$user['profile_image']) ?>" alt="<?= $user['name'] ?>">
                                        <?php else: ?>
                                            <?= substr($user['name'], 0, 1) ?>
                                        <?php endif; ?>
                                    </div>
                                    <span><?= $user['name'] ?></span>
                                </div>
                            </td>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <?php if($user['profile_image']): ?>
                                    <img src="<?= base_url('uploads/'.$user['profile_image']) ?>" class="profile-image" alt="Profile">
                                <?php else: ?>
                                    <span class="no-image">No image</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/users/edit/<?= $user['id'] ?>" class="edit-btn">
                                        <i class="material-icons">edit</i>
                                        <span>Edit</span>
                                    </a>
                                    <a href="/users/delete/<?= $user['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?')">
                                        <i class="material-icons">delete</i>
                                        <span>Delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

<?php include(__DIR__ .'/../include/footer.php'); ?>
=======
<?php include(__DIR__ .'/../include/header.php'); ?>
    <!-- Main Container -->
    <div class="container">
       
        <?php include(__DIR__ .'/../include/sidebar.php'); ?>

        <!-- Main Content -->
        <main class="main-content">
            <div class="users-header">
                <h1>Users Management</h1>
                <div class="header-actions">
                    <a href="/users/create" class="add-user-btn">
                        <i class="material-icons">person_add</i>
                        <span>Add New User</span>
                    </a>
                </div>
            </div>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="success-message">
                    <i class="material-icons">check_circle</i>
                    <span><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>

            <div class="users-table-container">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Profile Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td>#<?= $user['id'] ?></td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar-small">
                                        <?php if($user['profile_image']): ?>
                                            <img src="<?= base_url('uploads/'.$user['profile_image']) ?>" alt="<?= $user['name'] ?>">
                                        <?php else: ?>
                                            <?= substr($user['name'], 0, 1) ?>
                                        <?php endif; ?>
                                    </div>
                                    <span><?= $user['name'] ?></span>
                                </div>
                            </td>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <?php if($user['profile_image']): ?>
                                    <img src="<?= base_url('uploads/'.$user['profile_image']) ?>" class="profile-image" alt="Profile">
                                <?php else: ?>
                                    <span class="no-image">No image</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/users/edit/<?= $user['id'] ?>" class="edit-btn">
                                        <i class="material-icons">edit</i>
                                        <span>Edit</span>
                                    </a>
                                    <a href="/users/delete/<?= $user['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?')">
                                        <i class="material-icons">delete</i>
                                        <span>Delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

<?php include(__DIR__ .'/../include/footer.php'); ?>
>>>>>>> 95580eaf0a47ab4a9d4d01ae34bb382a65b00bff
