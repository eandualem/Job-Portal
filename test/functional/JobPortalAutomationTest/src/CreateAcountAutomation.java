import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.ui.Select;

public class CreateAcountAutomation {

    public static WebDriver employeeCreateAcount(WebDriver driver) throws InterruptedException {

        WebElement registerButton;
        WebElement continueButton;

        try {
            registerButton     = driver.findElement(By.xpath(".//*[@id='forgot']/a[2]"));
        }
        catch (Exception e){
            throw e;
        }
        registerButton.click();
        Thread.sleep(5000);

        try {
            continueButton     = driver.findElement(By.xpath(".//*[@id='signbtn']"));
        }
        catch (Exception e){
            throw e;
        }
        continueButton.click();
        Thread.sleep(2000);

        WebElement nameField;
        WebElement passwordField;
        WebElement cPasswordField;
        WebElement emailField;
        WebElement ageField;
        WebElement sexField;
        WebElement phoneField;
        WebElement postalField;
        WebElement countryField;
        WebElement regionField;
        WebElement cityField;
        WebElement addressField;
        WebElement aboutField;


        try {
            nameField        = driver.findElement(By.xpath("./html/body/div[2]/form/div[1]/input"));
            passwordField    = driver.findElement(By.xpath("./html/body/div[2]/form/div[2]/input"));
            cPasswordField   = driver.findElement(By.xpath("./html/body/div[2]/form/div[3]/input"));
            emailField       = driver.findElement(By.xpath("./html/body/div[2]/form/div[4]/input"));
            ageField         = driver.findElement(By.xpath("./html/body/div[2]/form/div[5]/input"));
            sexField         = driver.findElement(By.xpath("./html/body/div[2]/form/div[6]/input"));
            phoneField       = driver.findElement(By.xpath("./html/body/div[2]/form/div[7]/input"));
            postalField      = driver.findElement(By.xpath("./html/body/div[2]/form/div[8]/input"));
            countryField     = driver.findElement(By.xpath("./html/body/div[2]/form/div[9]/input"));
            regionField      = driver.findElement(By.xpath("./html/body/div[2]/form/div[10]/input"));
            cityField        = driver.findElement(By.xpath("./html/body/div[2]/form/div[11]/input"));
            addressField     = driver.findElement(By.xpath("./html/body/div[2]/form/div[12]/input"));
            aboutField       = driver.findElement(By.xpath("./html/body/div[2]/form/div[13]/textarea"));

            registerButton     = driver.findElement(By.xpath("./html/body/div[2]/form/div[14]/input"));
        }
        catch (Exception e){
            throw e;
        }

        nameField.sendKeys      ("Elias Andualem");
        passwordField.sendKeys  ("Satellite");
        cPasswordField.sendKeys ("Satellite");
        emailField.sendKeys     ("eandualem@gmail.com");
        ageField.sendKeys       ("22");
        sexField.sendKeys       ("M");
        phoneField.sendKeys     ("0911761693");
        postalField.sendKeys    ("1111");
        countryField.sendKeys   ("Ethiopia");
        regionField.sendKeys    ("AA");
        cityField.sendKeys      ("AA");
        addressField.sendKeys   ("4Kilo");
        aboutField.sendKeys     ("Am great");

        Thread.sleep(2000);
        registerButton.click();

        return driver;
    }

    public static WebDriver employerCreateAcount(WebDriver driver) throws InterruptedException {

        WebElement registerButton;
        WebElement continueButton;
        Select dropDown;

        try {
            registerButton     = driver.findElement(By.xpath(".//*[@id='forgot']/a[2]"));
        }
        catch (Exception e){
            throw e;
        }
        registerButton.click();
        Thread.sleep(5000);

        try {
            dropDown   = new Select(driver.findElement(By.xpath(".//*[@id='disabledSelect']")));
            continueButton     = driver.findElement(By.xpath(".//*[@id='signbtn']"));
        }
        catch (Exception e){
            throw e;
        }
        dropDown.selectByIndex(1);
        continueButton.click();
        Thread.sleep(2000);

        WebElement nameField;
        WebElement passwordField;
        WebElement cPasswordField;
        WebElement emailField;
        WebElement postalField;
        WebElement countryField;
        WebElement regionField;
        WebElement cityField;
        WebElement addressField;
        WebElement phoneField;


        try {
            nameField        = driver.findElement(By.xpath("./html/body/div[2]/form/div[1]/input"));
            passwordField    = driver.findElement(By.xpath("./html/body/div[2]/form/div[2]/input"));
            cPasswordField   = driver.findElement(By.xpath("./html/body/div[2]/form/div[3]/input"));
            emailField       = driver.findElement(By.xpath("./html/body/div[2]/form/div[4]/input"));
            postalField      = driver.findElement(By.xpath("./html/body/div[2]/form/div[5]/input"));
            countryField     = driver.findElement(By.xpath("./html/body/div[2]/form/div[6]/input"));
            regionField      = driver.findElement(By.xpath("./html/body/div[2]/form/div[7]/input"));
            cityField        = driver.findElement(By.xpath("./html/body/div[2]/form/div[7]/input"));
            addressField     = driver.findElement(By.xpath("./html/body/div[2]/form/div[8]/input"));
            phoneField       = driver.findElement(By.xpath("./html/body/div[2]/form/div[9]/input"));


            registerButton     = driver.findElement(By.xpath("./html/body/div[2]/form/div[14]/input"));
        }
        catch (Exception e){
            throw e;
        }

        nameField.sendKeys      ("Elias Andualem");
        passwordField.sendKeys  ("Satellite");
        cPasswordField.sendKeys ("Satellite");
        emailField.sendKeys     ("eandualem@gmail.com");
        phoneField.sendKeys     ("0911099351");
        postalField.sendKeys    ("1111");
        countryField.sendKeys   ("Ethiopia");
        regionField.sendKeys    ("AA");
        cityField.sendKeys      ("AA");
        addressField.sendKeys   ("4Kilo");

        Thread.sleep(2000);
        registerButton.click();

        return driver;
    }
}
