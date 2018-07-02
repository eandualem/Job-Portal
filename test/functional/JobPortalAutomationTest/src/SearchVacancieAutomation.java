import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.ui.Select;

public class SearchVacancieAutomation {

    public static WebDriver searchVacancies(WebDriver driver) throws InterruptedException {

        Select jobType;
        Select location;
        Select skillrequired;
        Select educationQualification;
        WebElement searchButton;


        try {
            jobType = new Select(driver.findElement(By.xpath(".//*[@id='JobType']")));
            location = new Select(driver.findElement(By.xpath(".//*[@id='Location']")));
            skillrequired = new Select(driver.findElement(By.xpath(".//*[@id='SkillRequired']")));
            educationQualification = new Select(driver.findElement(By.xpath(".//*[@id='EdQl']")));
            searchButton = driver.findElement(By.xpath(".//*[@id='searchbtn']"));
        }
        catch (Exception e){
            throw e;
        }

        jobType.selectByIndex(1);
        location.selectByIndex(2);
        skillrequired.selectByIndex(3);
        educationQualification.selectByIndex(1);
        searchButton.click();
        Thread.sleep(2000);

        return driver;

    }
}
