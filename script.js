// Declaring HTML id tags to JavaScrit Costants


//Getting date, time, timezone for the time widget
const timeEl = document.getElementById('time');
const dateEl = document.getElementById('date');
const timezone = document.getElementById('time-zone');

//Getting data for the today weather widget
const humidityEl = document.getElementById('humidity');
const pressureEl = document.getElementById('pressure');
const feelslikeEl = document.getElementById('feels_like');
const speedEl = document.getElementById('speed');
const mainEl = document.getElementById('main');
const iconEl = document.getElementById('icon');
const countryEl = document.getElementById('country');
const nameEl = document.getElementById('name');

//Getting data(forecast) for the tomorrow weather widget
const humidityFEl = document.getElementById('humidityF');
const pressureFEl = document.getElementById('pressureF');
const feelslikeFEl = document.getElementById('feels_likeF');
const speedFEl = document.getElementById('speedF');
const mainFEl = document.getElementById('mainF');
const iconFEl = document.getElementById('iconF');

//Getting data(forecast) for day after tomorrow weather widet
const humidityF2El = document.getElementById('humidityF2');
const pressureF2El = document.getElementById('pressureF2');
const feelslikeF2El = document.getElementById('feels_likeF2');
const speedF2El = document.getElementById('speedF2');
const mainF2El = document.getElementById('mainF2');
const iconF2El = document.getElementById('iconF2');

//Getting the day name for today, tomorrow and day after tomorrow
const date0El = document.getElementById("day0");
const date1El = document.getElementById("day1");
const date2El = document.getElementById("day2");

//Declaring names for the days of the week and months
const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

//Declaring the API KEY and city
const API_KEY = 'f633154c20aef3652fdc0560f22c5387';
var city = 'Dehiwala'


//Declaring variables to get the date and time and update every 1000 milliseconds
setInterval(() => {
    const time = new Date();
    const year = time.getFullYear();
    const month = time.getMonth();
    const date = time.getDate();
    const day = time.getDay();
    const hours = time.getHours();
    const hoursin12hourformat = hours >= 13 ? hours %12: hours;
    const minutes = time.getMinutes();
    const seconds = time.getSeconds();
    const ampm = hours >= 12 ? 'PM' : 'AM';

 
    //Displaying the date, time and day names
    timeEl.innerHTML = (hoursin12hourformat < 10 ? '0' + hoursin12hourformat : hoursin12hourformat) + ':' + (minutes < 10 ? '0' + minutes : minutes) + ' ' + ampm;
    dateEl.innerHTML = days[day] + ', ' + date + ' ' + months[month] + ' ' + year;
    date0El.innerHTML = days[day];
    date1El.innerHTML = days[(day+1) % days.length];
    date2El.innerHTML = days[(day+2) % days.length];   

}, 1000);


//Obtaining today weather data in an array
getWeatherData()
function getWeatherData(){

        fetch('https://api.openweathermap.org/data/2.5/weather?q=Dehiwala&appid=f633154c20aef3652fdc0560f22c5387').then(res => res.json()).then(data => {
            console.log(data)
            showWeatherData(data);
        })
}


//Assigning today weather data and passing via javascript id to display in the HTML code
function showWeatherData(data){

    let { humidity, pressure, feels_like } = data.main;
    let { speed } = data.wind;
    let { main, icon } = data.weather[0];
    let { country } = data.sys;

    humidityEl.innerHTML = humidity + '%';
    pressureEl.innerHTML = pressure + ' hPa';

    // Converting Kelvin Temperature to Celcius Temperature and Rounding Off to 1 Decimal Place
    feelslikeEl.innerHTML = (feels_like - 273).toFixed(1) + ' &#8451';  
                     
    speedEl.innerHTML = speed + ' m/s';
    mainEl.innerHTML = main;
    iconEl.innerHTML = `<img src="http://openweathermap.org/img/wn/${icon}@4x.png">`
    countryEl.innerHTML = country;
    timezone.innerHTML = data.name;
    
}




//Obtaining tomorrow(forecast) weather data in an array
getForecastWeatherData()
function getForecastWeatherData(){

    fetch('https://api.openweathermap.org/data/2.5/forecast?lat=6.8513&lon=79.866&appid=f633154c20aef3652fdc0560f22c5387').then(res => res.json()).then(data => {
        console.log(data)
        showForecastWeatherData(data);           
    })     
    
}

//Assigning tomorrow weather data and passing via javascript id to display in the HTML code
function showForecastWeatherData(data){
    
    let { humidity, pressure, feels_like } = data.list[9].main;
    let { speed } = data.list[9].wind;
    let { main, icon } = data.list[9].weather[0];

    humidityFEl.innerHTML = humidity + '%';
    pressureFEl.innerHTML = pressure + ' hPa';

    // Converting Kelvin Temperature to Celcius Temperature and Rounding Off to 1 Decimal Place
    feelslikeFEl.innerHTML = (feels_like - 273).toFixed(1) + ' &#8451';  
                     
    speedFEl.innerHTML = speed + ' m/s';
    mainFEl.innerHTML = main;
    iconFEl.innerHTML = `<img src="http://openweathermap.org/img/wn/${icon}@4x.png">`
    
}




// Obtaining day after tomorrow(forecast) weather data in an array
getForecastWeatherData2()
function getForecastWeatherData2(){

    fetch('https://api.openweathermap.org/data/2.5/forecast?lat=6.8513&lon=79.866&appid=f633154c20aef3652fdc0560f22c5387').then(res => res.json()).then(data => {
        console.log(data)
        showForecastWeatherData2(data);
    })
        
}

//Assigning day after tomorrow weather data and passing via javascript id to display in the HTML code
function showForecastWeatherData2(data){

    let { humidity, pressure, feels_like } = data.list[17].main;
    let { speed } = data.list[17].wind;
    let { main, icon } = data.list[17].weather[0];

    humidityF2El.innerHTML = humidity + '%';
    pressureF2El.innerHTML = pressure + ' hPa';

    // Converting Kelvin Temperature to Celcius Temperature and Rounding Off to 1 Decimal Place
    feelslikeF2El.innerHTML = (feels_like - 273).toFixed(1) + ' &#8451';  
                     
    speedF2El.innerHTML = speed + ' m/s';
    mainF2El.innerHTML = main;
    iconF2El.innerHTML = `<img src="http://openweathermap.org/img/wn/${icon}@4x.png">`
}





// Code for the popup pdf file and downloading process


//Daily Detailed Report
const dailyBtn = document.getElementById('daily');
dailyBtn.addEventListener('click', () => {
    const url = 'dailydetails.php'; 
    const windowFeatures = 'height=600,width=800,resizable=yes,scrollbars=yes,status=yes';
    const newWindow = window.open(url, '_blank', windowFeatures); //Open the report in a new window
    newWindow.focus();
});

//Weekly Detailed Report
const weeklyBtn = document.getElementById('weekly');
weeklyBtn.addEventListener('click', () => {
    const url = 'weeklydetails.php'; 
    const windowFeatures = 'height=600,width=800,resizable=yes,scrollbars=yes,status=yes';
    const newWindow = window.open(url, '_blank', windowFeatures); //Open the report in a new window
    newWindow.focus();
});

//Monthly Detailed Report
const monthlyBtn = document.getElementById('monthly');
monthlyBtn.addEventListener('click', () => {
    const url = 'monthlydetails.php'; 
    const windowFeatures = 'height=600,width=800,resizable=yes,scrollbars=yes,status=yes';
    const newWindow = window.open(url, '_blank', windowFeatures); //Open the report in a new window
    newWindow.focus();
});

//Seasonal Detailed Report
const seasonalBtn = document.getElementById('seasonal');
seasonalBtn.addEventListener('click', () => {
    const url = 'seasonaldetails.php'; 
    const windowFeatures = 'height=600,width=800,resizable=yes,scrollbars=yes,status=yes';
    const newWindow = window.open(url, '_blank', windowFeatures); //Open the report in a new window
    newWindow.focus();
});

//Yearly Detailed Report
const yearlyBtn = document.getElementById('yearly');
yearlyBtn.addEventListener('click', () => {
    const url = 'yearlydetails.php'; 
    const windowFeatures = 'height=600,width=800,resizable=yes,scrollbars=yes,status=yes';
    const newWindow = window.open(url, '_blank', windowFeatures); //Open the report in a new window
    newWindow.focus();
});

//Yield Report
const yieldBtn = document.getElementById('yield');
yieldBtn.addEventListener('click', () => {
    const url = 'yield.php';
    const windowFeatures = 'height=600,width=800,resizable=yes,scrollbars=yes,status=yes';
    const newWindow = window.open(url, '_blank', windowFeatures); //Open the report in a new window
    newWindow.focus();
});

//Acreage Report
const acreageBtn = document.getElementById('acreage');
acreageBtn.addEventListener('click', () => {
    const url = 'acreage.php'; 
    const windowFeatures = 'height=600,width=800,resizable=yes,scrollbars=yes,status=yes';
    const newWindow = window.open(url, '_blank', windowFeatures); //Open the report in a new window
    newWindow.focus();
});

// Validate Sign Up Form
function validateForm() {
    var firstname = document.getElementById('firstname').value;
    var lastname = document.getElementById('lastname').value;
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var cpassword = document.getElementById('cpassword').value;
    var workid = document.getElementById('workid').value;

    if (password.length < 8){
        alert('Password should contain minimum 8 characters');
        return false;
    }

    if(!isPasswordComplex(password)){
        alert('Pasword should contain atleast one upper case or lower case letter, a number and a symbol');
        return false;
    }

    if( password !== cpassword){
        alert('Password and Confirm Password doesn\'t match');
        return false;
    }

    if (!isEmail(email)){
        alert('Please enter a valid email');
        return false;
    }

    if (
        firstname === '' ||
        lastname === '' ||
        username === ''||
        email === '' ||
        password === '' ||
        cpassword === '' ||
        workid === '' 
    ){
        alert('Please fill out all the fields')
        return false;
    } else {
        return true;
    }

    function isPasswordComplex(password){
        var pattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&^#.,'\/+*=-])[A-Za-z\d@$!%*?&^#.,'\/+*=-]*$/;
        return pattern.test(password);
    }

    function isEmail(email){
        var regEx = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regEx.test(email);
    }
}

// Validate Sign In Form
function validateSignInForm(){
    var username = document.getElementById('usernameSI').value;
    var password = document.getElementById('passwordSI').value;
    var workid = document.getElementById('workidSI').value;

    
    if(
        username === '' ||
        password === '' ||
        workid === '' 
    ){
        alert('Please fill out all the fields');
        return false;
    } else {
        return true;
    }
}

// Validate Daily Details Form
function validateDailyDetailsForm(){
    
    var todayDate = document.getElementById('today_Date').value;
    var waterLevel = document.getElementById('water_level').value;
    var CWR = document.getElementById('cwr').value;
    var evaporation = document.getElementById('water_evap').value;
    var inflow = document.getElementById('water_inflow').value;

    function isNumeric(value) {
        return !isNaN(parseFloat(value)) && isFinite(value);
    }

    if (!isNumeric(waterLevel) || !isNumeric(CWR) || !isNumeric(evaporation) || !isNumeric(inflow)) {
        alert("Please enter numeric values for Water Level, Crop Water Requirement, Water Evaporation, and Water Inflow.");
        return false;
    }

    if(!isDateFormat(todayDate)){
        alert('Enter valid date format. Please use YYYY-MM-DD');
        return false;
    } 

    function isDateFormat(today_Date) {
        var regEx = new RegExp("^\\d{4}-\\d{2}-\\d{2}$");

        var dateObject = new Date(today_Date);
        var isValidDate = !isNaN(dateObject.getTime()); // NaN indicates an invalid date

        if (!isValidDate) {
            alert('Enter a valid date. For example, February 30th is not valid.');
            return false;
        }

        return regEx.test(today_Date);        
    }

    if(
        todayDate === '' ||
        waterLevel === '' ||
        CWR === '' ||
        evaporation === '' ||
        inflow === ''
    ){
        alert('Please fill out all the fields');
        return false;
    } else {
        return true;
    }
}

// Validate Water Issue Details Form
function validateWaterIssueForm(){
    var startDate = document.getElementById('s_date').value;
    var endDate = document.getElementById('e_date').value;
    var startTime = document.getElementById('s_time').value;
    var endTime = document.getElementById('e_time').value;
    var rbIssue = document.getElementById('rb_issue').value;
    var lbIssue = document.getElementById('lb_issue').value;

    

    function isNumeric(value) {
        return !isNaN(parseFloat(value)) && isFinite(value);
    }

    if (!isNumeric(rbIssue) || !isNumeric(lbIssue)) {
        alert("Please enter numeric values for RB Issue and LB Issue");
        return false;
    }

    if(!isDateFormatSD(startDate)){
        alert('Enter valid date format. Please use YYYY-MM-DD');
        return false;
    } 

    if(!isDateFormatED(endDate)){
        alert('Enter valid date format. Please use YYYY-MM-DD');
        return false;
    } 

    if(!isTimeFormatST(startTime)){
        alert('Enter valid time format. Please use HH:mm:ss');
        return false;
    }

    if(!isTimeFormatET(endTime)){
        alert('Enter valid time format. Please use HH:mm:ss');
        return false;
    }

    if(
        startDate === '' ||
        endDate === '' ||
        startTime === '' ||
        endTime === '' ||
        rbIssue === '' ||
        lbIssue === ''
    ){
        alert('Please fill out all the fields');
        return false;
    } else {
        window.location.href = 'index.php';
        return true; // Prevent the form from being submitted
    }

  
    
    function isDateFormatSD(startDate) {
        var regEx = new RegExp("^\\d{4}-\\d{2}-\\d{2}$");

        var dateObject = new Date(startDate);
        var isValidDate = !isNaN(dateObject.getTime()); // NaN indicates an invalid date

        if (!isValidDate) {
            alert('Enter a valid date. For example, February 30th is not valid.');
            return false;
        }

        return regEx.test(startDate);
    }

    function isDateFormatED(endDate) {
        var regEx = new RegExp("^\\d{4}-\\d{2}-\\d{2}$");

        var dateObject = new Date(endDate);
        var isValidDate = !isNaN(dateObject.getTime()); // NaN indicates an invalid date

        if (!isValidDate) {
            alert('Enter a valid date. For example, February 30th is not valid.');
            return false;
        }

        return regEx.test(endDate);
    }

    function isTimeFormatST(startTime) {
        var regEx = /^([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$/;
    
        if (!regEx.test(startTime)) {
            alert('Enter valid time format. Please use HH:mm:ss');
            return false;
        }
    
        var timeParts = startTime.split(':');
        var hours = parseInt(timeParts[0], 10);
        var minutes = parseInt(timeParts[1], 10);
        var seconds = parseInt(timeParts[2], 10);
    
        // Check if hours, minutes, and seconds are in valid ranges
        if (hours < 0 || hours > 23 || minutes < 0 || minutes > 59 || seconds < 0 || seconds > 59) {
            alert('Enter valid values for hours, minutes, and seconds');
            return false;
        }
        return true;
    }

    function isTimeFormatET(endTime){
        var regEx = new RegExp(/^([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$/);
        return regEx.test(endTime);
    }
}

// Validate Crop Details Form
function validateCropDetailsForm(){
    var cropYield = document.getElementById('yield').value;
    var cropAcreage = document.getElementById('acreage').value;
    var cropEnterDate = document.getElementById('date').value;

    function isNumeric(value) {
        return !isNaN(parseFloat(value)) && isFinite(value);
    }

    if (!isNumeric(cropAcreage) || !isNumeric(cropYield)) {
        alert("Please enter numeric values for Acreage and Yield");
        return false;
    }

    if(!isDate(cropEnterDate)){
        alert('Enter valid date format. Please use YYYY-MM-DD');
        return false;
    } 

    if(
        cropYield === '' ||
        cropAcreage === '' ||
        cropEnterDate === ''
    ){
        alert('Please fill out all the fields');
        return false;
    } else {
        return true;
    }

    function isDate(cropEnterDate) {
        var regEx = new RegExp("^\\d{4}-\\d{2}-\\d{2}$");

        var dateObject = new Date(cropEnterDate);
        var isValidDate = !isNaN(dateObject.getTime()); // NaN indicates an invalid date

        if (!isValidDate) {
            alert('Enter a valid date. For example, February 30th is not valid.');
            return false;
        }

        return regEx.test(cropEnterDate);
    }
}

function validateKeyword(){
    var keyword = document.getElementById('keyword').value;
    

    if(keyword === ''){
        alert('Please fill out the fields');
        return false;
    } 
}

// Validate Show Page Function
function showPage(pageId) {
    // Hide all content divs
    var contents = document.querySelectorAll('.content');
    contents.forEach(function(content) {
        content.classList.remove('active');
    });

    // Show the selected content div
    var selectedPage = document.getElementById(pageId);
    selectedPage.classList.add('active');
}

//Validate Toggle Function
const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})

// document.getElementById("logout").addEventListener('click', function(){
//     window.close();
// });


//Help page 
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
  
