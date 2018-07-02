import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.ui.Select;

public class LocationAutomation {

    public static WebDriver searchByLocation(WebDriver driver) throws InterruptedException {

        WebElement locationMenu;
        Select location;
        WebElement searchButton;
        WebElement applyButton;

        try {
            locationMenu     = driver.findElement(By.xpath("./html/body/div[2]/aside/div/ul/li[3]/a"));
        }
        catch (Exception e){
            throw e;
        }

        locationMenu.click();
        Thread.sleep(2000);


        try {
            location = new Select(driver.findElement(By.xpath(".//*[@id='searchbylocationbtn']")));
            searchButton = driver.findElement(By.xpath(".//*[@id='searchbtn']"));
        }
        catch (Exception e){
            throw e;
        }

        location.selectByIndex(1);
        searchButton.click();
        Thread.sleep(2000);

        return driver;

    }
}
