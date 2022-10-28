# CAMILE BASAHIN MO KO

# PAG GUSTO MO IDOWNLOAD YUNG BUONG FOLDER CLICK MO YUNG GREEN NA BUTTON DROPDOWN YON CLICK MO NALANG DOWNLOAD ZIP

## DESIGN
### Nilagay ko sa ASSETS folder yung mga CSS/JS or kung anong mga file need pang design.

__KAPAG NASA MAY SARILING FOLDER YUNG PHP/HTML file__
- ang path nung css or js files ay "../assets/(tapos name nung folder)/(filename nung css or js file)"

__KAPAG NASA LABAS NAMAN KASAMA YUNG INDEX.PHP__
- ang path nung css or js files ay "assets/(tapos name nung folder)/(filename nung css or js file)"
 
## YUNG SA DATABASE
Run mo muna XAMPP tapos import mo yung `sis_cdsp.sql`. Automatic na yan gagawa ng sariling database.

## WALA SA FIGMA NA PLAN KAYA BIGAY KO FLOW
### 1. YUNG SA PAG __REGISTER__ NASA ISIP KO NA FLOW GANITO
1. May hawak na silang __Student Number__. 
2. I input nila then yung __Student Number__ sa `studentnumber.php` na page.
3. Pagtapos iverify yon pupunta silang `signup.php` na page.

### 2. YUNG SA PAG __RESET PASSWORD__ NASA ISIP KO NA FLOW GANITO
1. I input nila yung __Email Address__ sa `verify.php` na page.
2. Pagtapos iverify yon pupunta silang `reset.php` na page.

## MAY SIRA OR DI KO NA TANDA KUNG NAGANA NG TAMA
### ABOUT SA PHP FILES NA WALANG KADESIGN DESIGN
Nilagay ko yon doon kasi working yung iba doon pero baka may mali pang path hayaan muna kasi tinatamad pa ako isa isahin mga file path.

### YUNG SA SCAN QR CODE
Di ko tanda kung nag d display ba ng error na mali yung QR Code na pinapakita. 
Basta mag base nalang kayo dun sa table `studentrecord` dun sa sis_cdsp nandoon yung `Student Number`.

### DI KO RIN SURE ABOUT SA CAMERA NA GAGAMITIN SA CAMERA.
Kung ka naman nagamit ng OBS Virtual Camera automatic na niya gagamitin yung Camera sa Laptop mo. 
Di siya nagana sa mga hosting site na di paid or wala yung ssl something kaya di ko pa matry sa phone.
