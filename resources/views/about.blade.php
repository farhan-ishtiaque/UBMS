
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About UBMS Bangladesh</title>
    <div class="header-divider"></div>
                <p class="tagline">Digital Transformation for Academic Excellence</p>
            </div>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
</head>
<body>
    <div class="ubms-container">
        <h2>Comprehensive University Governance Platform</h2>
        <p class="ubms-intro">UBMS is the flagship initiative to modernize higher education administration through cutting-edge technology. This integrated web-based solution serves as the central platform for coordinating all academic operations across Bangladeshi universities.</p>
        
      <!-- Former Chairmen Table -->
<div class="dropdown" onclick="toggleDropdown('former-chairmen')">
    <div class="dropdown-header">
        <span><i class="fas fa-users"></i> Former Chairmen</span>
        <span class="dropdown-icon"><i class="fas fa-chevron-down"></i></span>
    </div>
    <div class="dropdown-content" id="former-chairmen-content">
        <div class="table-responsive">
            <table class="ubms-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Period</th>
                        <th>From</th>
                        <th>To</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td onclick="window.open('https://www.linkedin.com/in/farhan-ishtiaque?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app', '_blank')" style="cursor: pointer;">Professor Dr.Farhan Ishtiaque</td>
    <td>2006 - 2010</td>
    <td>2006</td>
    <td>2010</td>
</tr>
<tr><td onclick="window.open('https://www.linkedin.com/in/asfiya-chowdhury?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app', '_blank')" style="cursor: pointer;">Professor Dr. Asfiya Rashid Chowdhury</td>
    <td>2011 - 2015</td>
    <td>2011</td>
    <td>2015</td>
</tr>
<tr><td onclick="window.open('https://www.linkedin.com/in/minhaj-rafi-837414314?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app', '_blank')" style="cursor: pointer;">Professor Dr. Minhaj Rafi</td>
                        <td>2016 - 2021</td>
                        <td>2016</td>
                        <td>2021</td>
                    </tr>
<tr ><td onclick="window.open('https://www.linkedin.com/in/ahmed-11-kiser?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app', '_blank')" style="cursor: pointer;">Professor Dr. Ahmed Kiser</td>
                        <td>2022 - Present</td>
                        <td>2022</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

        <!-- Standing Committees -->
        <div class="dropdown">
            <div class="dropdown-header" onclick="toggleDropdown('committees')">
                <span>Standing Committees</span>
                <span class="dropdown-icon">▼</span>
            </div>
            <div class="dropdown-content" id="committees-content">
                <ul class="committee-list">
                    <li>Finance Committee</li>
                    <li>Selection Committee for Grade 1-10</li>
                    <li>Selection Committee for Grade 11-20</li>
                    <li>Committee for up-gradation and Promotion</li>
                    <li>Tender Opening Committee</li>
                    <li>Tender Evaluation Committee</li>
                    <li>General Purchase Committee</li>
                    <li>Electrical & Electronic Materials Purchase Committee</li>
                </ul>
            </div>
        </div>

        <!-- Mission Section -->
        <div class="dropdown">
            <div class="dropdown-header" onclick="toggleDropdown('mission')">
                <span>Mission</span>
                <span class="dropdown-icon">▼</span>
            </div>
            <div class="dropdown-content" id="mission-content">
                <ul class="mission-list">
                    <li>Standardize academic operations nationwide</li>
                    <li>Provide real-time institutional performance analytics</li>
                    <li>Automate regulatory compliance processes</li>
                    <li>Facilitate data-driven decision making</li>
                    <li>Scholarship & Financial Aid Managemen</li>
                </ul>
            </div>
        </div>

        <!-- Vision Section -->
        <div class="dropdown">
            <div class="dropdown-header" onclick="toggleDropdown('vision')">
                <span>Vision</span>
                <span class="dropdown-icon">▼</span>
            </div>
            <div class="dropdown-content" id="vision-content">
                <p class="vision-text">
                    To facilitate and guide the universities to achieve excellence in higher education 
                    and innovative research for sustainable socio-economic development and building 
                    a knowledge based economy through promoting good governance and management at 
                    the higher education institutions in Bangladesh.
                </p>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown(id) {
            const content = document.getElementById(id + '-content');
            const icon = document.querySelector(`.dropdown-header[onclick="toggleDropdown('${id}')"] .dropdown-icon`);
            
            content.classList.toggle('show');
            icon.classList.toggle('rotate');
        }
    </script>
</body>
</html>