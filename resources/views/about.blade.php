<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About UBMS - University Management of Bangladesh</title>
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
</head>
<body>
    <h1>About UBMS</h1>
    <p>The University Management of Bangladesh (UBMS) is the premier governing body overseeing higher education institutions across Bangladesh.</p>
    
    <div class="dropdown">
        <div class="dropdown-header" onclick="toggleDropdown('vision')">
            <span>Vision</span>
            <span class="dropdown-icon">▼</span>
        </div>
        <div class="dropdown-content" id="vision-content">
            <p>To transform Bangladesh's higher education system into a world-class platform that fosters innovation and research excellence.</p>
        </div>
    </div>
    
    <div class="dropdown">
        <div class="dropdown-header" onclick="toggleDropdown('mission')">
            <span>Mission</span>
            <span class="dropdown-icon">▼</span>
        </div>
        <div class="dropdown-content" id="mission-content">
            <ul>
                <li>Ensure quality assurance</li>
                <li>Promote research and innovation</li>
                <li>Develop curriculum standards</li>
                <li>Facilitate academia-industry collaboration</li>
            </ul>
        </div>
    </div>
    
    <div class="dropdown">
        <div class="dropdown-header" onclick="toggleDropdown('governance')">
            <span>Governance</span>
            <span class="dropdown-icon">▼</span>
        </div>
        <div class="dropdown-content" id="governance-content">
            <h3>Standing Committees</h3>
            <ul>
                <li>Academic Council</li>
                <li>Finance Committee</li>
                <li>Research Committee</li>
                <li>Quality Assurance</li>
            </ul>
        </div>
    </div>
    
    <div class="dropdown">
        <div class="dropdown-header" onclick="toggleDropdown('history')">
            <span>History</span>
            <span class="dropdown-icon">▼</span>
        </div>
        <div class="dropdown-content" id="history-content">
            <div class="history-timeline">
                <div class="timeline-item">
                    <h3>1973 - Establishment</h3>
                    <div class="timeline-connector"></div>
                </div>
                <div class="timeline-item">
                    <h3>1985 - Expansion</h3>
                    <div class="timeline-connector"></div>
                </div>
                <div class="timeline-item">
                    <h3>2020 - COVID Response</h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="dropdown">
        <div class="dropdown-header" onclick="toggleDropdown('leadership')">
            <span>Leadership</span>
            <span class="dropdown-icon">▼</span>
        </div>
        <div class="dropdown-content" id="leadership-content">
            <ul>
                <li>Prof. A.B.M. Farooque (1973-1978)</li>
                <li>Dr. Naila Zaman Khan (1978-1985)</li>
                <li>Prof. Muhammad Zafar Iqbal (2020-Present)</li>
            </ul>
        </div>
    </div>
    
    <script>
        function toggleDropdown(id) {
            const content = document.getElementById(id + '-content');
            const icon = document.querySelector(`#${id}-content`).previousElementSibling.querySelector('.dropdown-icon');
            
            content.classList.toggle('show');
            icon.classList.toggle('rotate');
        }
    </script>
</body>
</html>