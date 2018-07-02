import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;

public class TestRunner {

    private static int passed_test;

    public static void main(String[] args) throws InterruptedException {

        System.setProperty("webdriver.chrome.driver", "./chromedriver");
        WebDriver driver = new ChromeDriver();
        driver.get("http://localhost:8888/jobportal/");

        passed_test = 0;

        try {
            // Test system login and register works
            LoginAutomation .loginEmployee(driver);   // login as Employee
            passed_test++;
            driver = LoginAutomation.logout(driver);  // logout
            passed_test++;
            LoginAutomation .loginEmployer(driver);   // login as Employer
            passed_test++;
            driver = LoginAutomation.logout(driver);  // logout
            passed_test++;
            driver = CreateAcountAutomation.employeeCreateAcount(driver);    // employee creates account
            passed_test++;
            driver = LoginAutomation.logout(driver);  // logout
            passed_test++;
            driver = CreateAcountAutomation.employerCreateAcount(driver);    // employer creates account
            passed_test++;
            driver = LoginAutomation.logout(driver);  // logout
            passed_test++;

            // Employee functionality of the system works
            driver = LoginAutomation.loginEmployee(driver);   // login as Employee
            passed_test++;
            driver = SearchVacancieAutomation.searchVacancies(driver);  // search for vacancies
            passed_test++;
            driver = CategoryAutomation.searchByCategory(driver);   // search for vacancies by category.
            passed_test++;
            driver = LocationAutomation.searchByLocation(driver);   // search for vacancies by location.
            passed_test++;
            driver = AcceptedApplication.agree(driver); // Agree to work from accepted applications.
            passed_test++;
            driver = FormerEmployers.former(driver);    // Look at list of former employers
            passed_test++;


            // Employer functionality of the system works
            driver = LoginAutomation.loginEmployer(driver);   // login as Employer
            passed_test++;
            driver = AddVacancies.add(driver);  // add new vacancies
            passed_test++;
            driver = AcceptApplied.accept(driver);  // accept applied employees
            passed_test++;
            driver = FormerEmployees.former(driver);    // Look at list of former employees
            passed_test++;
        }
        catch (Exception e){
            throw e;
        }

        System.out.println("All test Passed");
        System.out.println("Number of tests passed: " + passed_test);


    }}
