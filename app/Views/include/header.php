<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', 'Segoe UI', Arial, sans-serif;
        }

        body {
            background: #f8f9fa;
            color: #202124;
        }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 24px;
            background: white;
            border-bottom: 1px solid #dadce0;
            position: sticky;
            top: 0;
            z-index: 100;
            height: 64px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo {
            font-size: 22px;
            font-weight: 500;
            color: #5f6368;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            color: #4285f4;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #5f6368;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background 0.2s;
        }

        .menu-toggle:hover {
            background: #f1f3f4;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: #f1f3f4;
            border-radius: 8px;
            padding: 8px 16px;
            width: 500px;
        }

        .search-bar input {
            background: transparent;
            border: none;
            outline: none;
            width: 100%;
            padding: 0 10px;
            font-size: 16px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .header-icon:hover {
            background: #f1f3f4;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4285f4, #34a853);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            cursor: pointer;
        }

        /* Sidebar Toggle Styles */
        .sidebar-toggle {
            position: fixed;
            top: 80px;
            left: 0;
            z-index: 99;
            background: white;
            border: 1px solid #dadce0;
            border-left: none;
            border-radius: 0 8px 8px 0;
            padding: 10px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 2px 0 8px rgba(0,0,0,0.1);
        }

        .sidebar-toggle:hover {
            background: #f8f9fa;
        }

        /* Container */
        .container {
            display: flex;
            min-height: calc(100vh - 64px);
        }

        /* Sidebar */
        .sidebar {
            width: 256px;
            background: white;
            border-right: 1px solid #dadce0;
            padding: 20px 0;
            position: sticky;
            top: 64px;
            height: calc(100vh - 64px);
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        .sidebar-section {
            padding: 8px 0;
            border-bottom: 1px solid #e8eaed;
            margin-bottom: 10px;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #5f6368;
            text-decoration: none;
            transition: background 0.2s;
            cursor: pointer;
        }

        .sidebar-item:hover {
            background: #f1f3f4;
        }

        .sidebar-item.active {
            background: #e8f0fe;
            color: #1967d2;
            border-right: 3px solid #1967d2;
        }

        .sidebar-item i {
            font-size: 20px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
            transition: margin-left 0.3s ease;
        }

        /* Rest of your CSS styles remain the same */
        .welcome-card {
            background: white;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid #dadce0;
        }

        .welcome-card h1 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #202124;
        }

        .welcome-card p {
            color: #5f6368;
            font-size: 16px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            border: 1px solid #dadce0;
            transition: box-shadow 0.2s;
        }

        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .stat-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .stat-card:nth-child(1) .stat-icon { background: #4285f4; }
        .stat-card:nth-child(2) .stat-icon { background: #34a853; }
        .stat-card:nth-child(3) .stat-icon { background: #fbbc04; }
        .stat-card:nth-child(4) .stat-icon { background: #ea4335; }

        .stat-value {
            font-size: 32px;
            font-weight: 500;
            color: #202124;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #5f6368;
            font-size: 14px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .content-card {
            background: white;
            border-radius: 8px;
            padding: 25px;
            border: 1px solid #dadce0;
        }

        .content-card h3 {
            color: #202124;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #f1f3f4;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f1f3f4;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5f6368;
        }

        /* Users Page Styles */
        .users-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .users-header h1 {
            font-size: 28px;
            color: #202124;
            margin: 0;
        }

        .add-user-btn, .back-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.2s;
        }

        .add-user-btn {
            background: #4285f4;
            color: white;
        }

        .add-user-btn:hover {
            background: #3367d6;
            text-decoration: none;
            color: white;
        }

        .back-btn {
            background: #f1f3f4;
            color: #5f6368;
        }

        .back-btn:hover {
            background: #e8eaed;
            text-decoration: none;
            color: #202124;
        }

        .success-message {
            background: #e6f4ea;
            color: #137333;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #34a853;
        }

        .success-message i {
            font-size: 20px;
        }

        .error-messages {
            background: #fce8e6;
            color: #c5221f;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #ea4335;
        }

        .error-messages ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .error-messages li {
            margin-bottom: 5px;
            padding-left: 20px;
            position: relative;
        }

        .error-messages li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #c5221f;
            font-weight: bold;
        }

        /* Users Table */
        .users-table-container {
            background: white;
            border-radius: 8px;
            border: 1px solid #dadce0;
            overflow: hidden;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table thead {
            background: #f8f9fa;
            border-bottom: 2px solid #e8eaed;
        }

        .users-table th {
            padding: 16px 20px;
            text-align: left;
            color: #5f6368;
            font-weight: 500;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .users-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f3f4;
            color: #202124;
        }

        .users-table tbody tr:hover {
            background: #f8f9fa;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar-small {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4285f4, #34a853);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            font-size: 14px;
        }

        .user-avatar-small img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 6px;
            object-fit: cover;
            border: 1px solid #e8eaed;
        }

        .no-image {
            color: #5f6368;
            font-size: 14px;
            font-style: italic;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .edit-btn, .delete-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.2s;
        }

        .edit-btn {
            background: #e8f0fe;
            color: #1967d2;
        }

        .edit-btn:hover {
            background: #d2e3fc;
            text-decoration: none;
        }

        .delete-btn {
            background: #fce8e6;
            color: #c5221f;
        }

        .delete-btn:hover {
            background: #fad2cf;
            text-decoration: none;
        }

        .edit-btn i, .delete-btn i {
            font-size: 16px;
        }

        /* Form Styles */
        .form-container {
            background: white;
            border-radius: 8px;
            padding: 30px;
            border: 1px solid #dadce0;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #202124;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group label[for]::after {
            content: " *";
            color: #ea4335;
        }

        .form-group label[for="profile_image"]::after,
        .form-group label[for="password"]::after {
            content: "";
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4285f4;
            box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.1);
        }

        .form-help {
            display: block;
            margin-top: 6px;
            color: #5f6368;
            font-size: 12px;
        }

        /* Password Input */
        .password-input {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #5f6368;
            cursor: pointer;
            padding: 5px;
        }

        .toggle-password:hover {
            color: #202124;
        }

        /* Image Upload */
        .current-image {
            margin-top: 10px;
        }

        .current-image img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e8eaed;
        }

        .no-image {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            color: #5f6368;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #dadce0;
        }

        .no-image i {
            font-size: 40px;
        }

        /* File Upload Styles */
        .file-upload {
            margin-top: 10px;
        }

        .file-upload input[type="file"] {
            display: none;
        }

        .file-upload-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #f8f9fa;
            color: #5f6368;
            padding: 12px 20px;
            border-radius: 6px;
            border: 2px dashed #dadce0;
            cursor: pointer;
            transition: all 0.2s;
        }

        .file-upload-label:hover {
            background: #e8f0fe;
            border-color: #4285f4;
            color: #1967d2;
        }

        /* File Upload Area (Create Page) */
        .file-upload-area {
            position: relative;
            border: 2px dashed #dadce0;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            transition: border-color 0.2s;
            margin-top: 10px;
        }

        .file-upload-area:hover {
            border-color: #4285f4;
        }

        .file-input {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .upload-placeholder {
            color: #5f6368;
        }

        .upload-placeholder i {
            font-size: 48px;
            margin-bottom: 10px;
            color: #dadce0;
        }

        .upload-placeholder p {
            margin: 10px 0;
            font-size: 16px;
        }

        .upload-placeholder span {
            font-size: 12px;
        }

        .image-preview {
            display: none;
            margin-top: 20px;
        }

        .image-preview img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            border: 2px solid #e8eaed;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e8eaed;
            flex-wrap: wrap;
        }

        .submit-btn, .reset-btn, .cancel-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            border: none;
        }

        .submit-btn {
            background: #34a853;
            color: white;
        }

        .submit-btn:hover {
            background: #2d8c47;
        }

        .submit-btn[type="submit"] {
            background: #4285f4;
        }

        .submit-btn[type="submit"]:hover {
            background: #3367d6;
        }

        .reset-btn {
            background: #fbbc04;
            color: white;
        }

        .reset-btn:hover {
            background: #f9ab00;
        }

        .cancel-btn {
            background: #f1f3f4;
            color: #5f6368;
        }

        .cancel-btn:hover {
            background: #e8eaed;
            color: #202124;
            text-decoration: none;
        }

        /* Footer */
        .footer {
            background: white;
            border-top: 1px solid #dadce0;
            padding: 20px 30px;
            color: #5f6368;
            font-size: 14px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-links {
            display: flex;
            gap: 20px;
        }

        .footer-links a {
            color: #5f6368;
            text-decoration: none;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .search-bar {
                width: 300px;
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .sidebar {
                position: fixed;
                left: 0;
                top: 64px;
                height: calc(100vh - 64px);
                transform: translateX(-100%);
                z-index: 99;
                width: 280px;
                box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0 !important;
                padding: 20px;
            }
            
            .search-bar {
                display: none;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .users-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .users-table {
                display: block;
                overflow-x: auto;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .submit-btn, .reset-btn, .cancel-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>


    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <button class="menu-toggle" id="menuToggle">
                <i class="material-icons">menu</i>
            </button>
            <div class="logo">
                <i class="material-icons">dashboard</i>
                <span>Dashboard</span>
            </div>
            <div class="search-bar">
                <i class="material-icons">search</i>
                <input type="text" placeholder="Search...">
            </div>
        </div>
        <div class="header-right">
            <div class="header-icon">
                <i class="material-icons">help_outline</i>
            </div>
            <div class="header-icon">
                <i class="material-icons">settings</i>
            </div>
            <div class="header-icon">
                <i class="material-icons">notifications</i>
            </div>
            <div class="user-avatar">JD</div>
        </div>
    </header>
    

=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', 'Segoe UI', Arial, sans-serif;
        }

        body {
            background: #f8f9fa;
            color: #202124;
        }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 24px;
            background: white;
            border-bottom: 1px solid #dadce0;
            position: sticky;
            top: 0;
            z-index: 100;
            height: 64px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo {
            font-size: 22px;
            font-weight: 500;
            color: #5f6368;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            color: #4285f4;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #5f6368;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background 0.2s;
        }

        .menu-toggle:hover {
            background: #f1f3f4;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: #f1f3f4;
            border-radius: 8px;
            padding: 8px 16px;
            width: 500px;
        }

        .search-bar input {
            background: transparent;
            border: none;
            outline: none;
            width: 100%;
            padding: 0 10px;
            font-size: 16px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .header-icon:hover {
            background: #f1f3f4;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4285f4, #34a853);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            cursor: pointer;
        }

        /* Sidebar Toggle Styles */
        .sidebar-toggle {
            position: fixed;
            top: 80px;
            left: 0;
            z-index: 99;
            background: white;
            border: 1px solid #dadce0;
            border-left: none;
            border-radius: 0 8px 8px 0;
            padding: 10px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 2px 0 8px rgba(0,0,0,0.1);
        }

        .sidebar-toggle:hover {
            background: #f8f9fa;
        }

        /* Container */
        .container {
            display: flex;
            min-height: calc(100vh - 64px);
        }

        /* Sidebar */
        .sidebar {
            width: 256px;
            background: white;
            border-right: 1px solid #dadce0;
            padding: 20px 0;
            position: sticky;
            top: 64px;
            height: calc(100vh - 64px);
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        .sidebar-section {
            padding: 8px 0;
            border-bottom: 1px solid #e8eaed;
            margin-bottom: 10px;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #5f6368;
            text-decoration: none;
            transition: background 0.2s;
            cursor: pointer;
        }

        .sidebar-item:hover {
            background: #f1f3f4;
        }

        .sidebar-item.active {
            background: #e8f0fe;
            color: #1967d2;
            border-right: 3px solid #1967d2;
        }

        .sidebar-item i {
            font-size: 20px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
            transition: margin-left 0.3s ease;
        }

        /* Rest of your CSS styles remain the same */
        .welcome-card {
            background: white;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid #dadce0;
        }

        .welcome-card h1 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #202124;
        }

        .welcome-card p {
            color: #5f6368;
            font-size: 16px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            border: 1px solid #dadce0;
            transition: box-shadow 0.2s;
        }

        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .stat-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .stat-card:nth-child(1) .stat-icon { background: #4285f4; }
        .stat-card:nth-child(2) .stat-icon { background: #34a853; }
        .stat-card:nth-child(3) .stat-icon { background: #fbbc04; }
        .stat-card:nth-child(4) .stat-icon { background: #ea4335; }

        .stat-value {
            font-size: 32px;
            font-weight: 500;
            color: #202124;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #5f6368;
            font-size: 14px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .content-card {
            background: white;
            border-radius: 8px;
            padding: 25px;
            border: 1px solid #dadce0;
        }

        .content-card h3 {
            color: #202124;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #f1f3f4;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f1f3f4;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5f6368;
        }

        /* Users Page Styles */
        .users-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .users-header h1 {
            font-size: 28px;
            color: #202124;
            margin: 0;
        }

        .add-user-btn, .back-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.2s;
        }

        .add-user-btn {
            background: #4285f4;
            color: white;
        }

        .add-user-btn:hover {
            background: #3367d6;
            text-decoration: none;
            color: white;
        }

        .back-btn {
            background: #f1f3f4;
            color: #5f6368;
        }

        .back-btn:hover {
            background: #e8eaed;
            text-decoration: none;
            color: #202124;
        }

        .success-message {
            background: #e6f4ea;
            color: #137333;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #34a853;
        }

        .success-message i {
            font-size: 20px;
        }

        .error-messages {
            background: #fce8e6;
            color: #c5221f;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #ea4335;
        }

        .error-messages ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .error-messages li {
            margin-bottom: 5px;
            padding-left: 20px;
            position: relative;
        }

        .error-messages li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #c5221f;
            font-weight: bold;
        }

        /* Users Table */
        .users-table-container {
            background: white;
            border-radius: 8px;
            border: 1px solid #dadce0;
            overflow: hidden;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table thead {
            background: #f8f9fa;
            border-bottom: 2px solid #e8eaed;
        }

        .users-table th {
            padding: 16px 20px;
            text-align: left;
            color: #5f6368;
            font-weight: 500;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .users-table td {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f3f4;
            color: #202124;
        }

        .users-table tbody tr:hover {
            background: #f8f9fa;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar-small {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4285f4, #34a853);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            font-size: 14px;
        }

        .user-avatar-small img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 6px;
            object-fit: cover;
            border: 1px solid #e8eaed;
        }

        .no-image {
            color: #5f6368;
            font-size: 14px;
            font-style: italic;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .edit-btn, .delete-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.2s;
        }

        .edit-btn {
            background: #e8f0fe;
            color: #1967d2;
        }

        .edit-btn:hover {
            background: #d2e3fc;
            text-decoration: none;
        }

        .delete-btn {
            background: #fce8e6;
            color: #c5221f;
        }

        .delete-btn:hover {
            background: #fad2cf;
            text-decoration: none;
        }

        .edit-btn i, .delete-btn i {
            font-size: 16px;
        }

        /* Form Styles */
        .form-container {
            background: white;
            border-radius: 8px;
            padding: 30px;
            border: 1px solid #dadce0;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #202124;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group label[for]::after {
            content: " *";
            color: #ea4335;
        }

        .form-group label[for="profile_image"]::after,
        .form-group label[for="password"]::after {
            content: "";
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4285f4;
            box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.1);
        }

        .form-help {
            display: block;
            margin-top: 6px;
            color: #5f6368;
            font-size: 12px;
        }

        /* Password Input */
        .password-input {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #5f6368;
            cursor: pointer;
            padding: 5px;
        }

        .toggle-password:hover {
            color: #202124;
        }

        /* Image Upload */
        .current-image {
            margin-top: 10px;
        }

        .current-image img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e8eaed;
        }

        .no-image {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            color: #5f6368;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #dadce0;
        }

        .no-image i {
            font-size: 40px;
        }

        /* File Upload Styles */
        .file-upload {
            margin-top: 10px;
        }

        .file-upload input[type="file"] {
            display: none;
        }

        .file-upload-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #f8f9fa;
            color: #5f6368;
            padding: 12px 20px;
            border-radius: 6px;
            border: 2px dashed #dadce0;
            cursor: pointer;
            transition: all 0.2s;
        }

        .file-upload-label:hover {
            background: #e8f0fe;
            border-color: #4285f4;
            color: #1967d2;
        }

        /* File Upload Area (Create Page) */
        .file-upload-area {
            position: relative;
            border: 2px dashed #dadce0;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            transition: border-color 0.2s;
            margin-top: 10px;
        }

        .file-upload-area:hover {
            border-color: #4285f4;
        }

        .file-input {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .upload-placeholder {
            color: #5f6368;
        }

        .upload-placeholder i {
            font-size: 48px;
            margin-bottom: 10px;
            color: #dadce0;
        }

        .upload-placeholder p {
            margin: 10px 0;
            font-size: 16px;
        }

        .upload-placeholder span {
            font-size: 12px;
        }

        .image-preview {
            display: none;
            margin-top: 20px;
        }

        .image-preview img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            border: 2px solid #e8eaed;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e8eaed;
            flex-wrap: wrap;
        }

        .submit-btn, .reset-btn, .cancel-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            border: none;
        }

        .submit-btn {
            background: #34a853;
            color: white;
        }

        .submit-btn:hover {
            background: #2d8c47;
        }

        .submit-btn[type="submit"] {
            background: #4285f4;
        }

        .submit-btn[type="submit"]:hover {
            background: #3367d6;
        }

        .reset-btn {
            background: #fbbc04;
            color: white;
        }

        .reset-btn:hover {
            background: #f9ab00;
        }

        .cancel-btn {
            background: #f1f3f4;
            color: #5f6368;
        }

        .cancel-btn:hover {
            background: #e8eaed;
            color: #202124;
            text-decoration: none;
        }

        /* Footer */
        .footer {
            background: white;
            border-top: 1px solid #dadce0;
            padding: 20px 30px;
            color: #5f6368;
            font-size: 14px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-links {
            display: flex;
            gap: 20px;
        }

        .footer-links a {
            color: #5f6368;
            text-decoration: none;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .search-bar {
                width: 300px;
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .sidebar {
                position: fixed;
                left: 0;
                top: 64px;
                height: calc(100vh - 64px);
                transform: translateX(-100%);
                z-index: 99;
                width: 280px;
                box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0 !important;
                padding: 20px;
            }
            
            .search-bar {
                display: none;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .users-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .users-table {
                display: block;
                overflow-x: auto;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .submit-btn, .reset-btn, .cancel-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>


    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <button class="menu-toggle" id="menuToggle">
                <i class="material-icons">menu</i>
            </button>
            <div class="logo">
                <i class="material-icons">dashboard</i>
                <span>Dashboard</span>
            </div>
            <div class="search-bar">
                <i class="material-icons">search</i>
                <input type="text" placeholder="Search...">
            </div>
        </div>
        <div class="header-right">
            <div class="header-icon">
                <i class="material-icons">help_outline</i>
            </div>
            <div class="header-icon">
                <i class="material-icons">settings</i>
            </div>
            <div class="header-icon">
                <i class="material-icons">notifications</i>
            </div>
            <div class="user-avatar">JD</div>
        </div>
    </header>
    

>>>>>>> 95580eaf0a47ab4a9d4d01ae34bb382a65b00bff
   