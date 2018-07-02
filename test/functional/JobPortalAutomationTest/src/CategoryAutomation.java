import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.ui.Select;

public class CategoryAutomation {

    public static WebDriver searchByCategory(WebDriver driver) throws InterruptedException {

        WebElement categoryMenu;
        WebElement searchButton;
        Select category;

        try {
            categoryMenu     = driver.findElement(By.xpath("./html/body/div[2]/aside/div/ul/li[2]/a"));
        }
        catch (Exception e){
            throw e;
        }

        categoryMenu.click();
        Thread.sleep(2000);


        try {
            category = new Select(driver.findElement(By.xpath(".//*[@id='JobType2']")));
            searchButton = driver.findElement(By.xpath(".//*[@id='searchbycategotybtn']"));
        }
        catch (Exception e){
            throw e;
        }

        category.selectByIndex(1);
        searchButton.click();
        Thread.sleep(2000);

        return driver;

    }
}
