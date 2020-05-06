from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import unittest
import inspect
import time

# java -jar selenium-server-standalone-3.141.59.jar
# CLI command to start the selenium server on port 4444


class TestWebsite(unittest.TestCase):
    """A class that holds tests to be run for game-aid

        Roy Ortega - A01078553
        ACIT 2911 - Set 2B
        May 2, 2020"""

    def setUp(self) -> None:
        """Initializes a test"""
        self.driver = webdriver.Chrome('./chromedriver')
        self.driver.get("http://game-aid.ca/wp/")
        self.driver.implicitly_wait(2) # Waits in seconds to find elements
        self.logPoint()

    def tearDown(self):
        """Log point for end of test"""
        self.driver.close()
        self.logPoint()

    def logPoint(self):
        """Creates log point function to be run after each set up and teardown"""
        currentTest = self.id().split('.')[-1]
        callingFunction = inspect.stack()[1][3]
        print('in %s - %s()' % (currentTest, callingFunction))

    def test_logo(self):
        """TP000-A Tests the logo portion of the header"""
        print('Testing Logo')
        logo = self.driver.find_element_by_xpath('//a')
        logo.click()
        current_url = self.driver.current_url
        self.assertEqual(current_url, 'http://game-aid.ca/wp/', 'Should return http://game-aid.ca/wp/')

    def test_fps(self):
        """TP001-A Tests clicking an image in the front page"""
        print('Testing FPS Row - Landing Page')
        img_1 = self.driver.find_element_by_id('fps-i1')
        img_2 = self.driver.find_element_by_id('fps-i2')
        img_3 = self.driver.find_element_by_id('fps-i3')
        img_4 = self.driver.find_element_by_id('fps-i4')
        click_button = self.driver.find_element_by_id('fps-click')

        img_1.click()
        img_2.click()
        img_3.click()
        img_4.click()
        click_button.click()

    def test_mmo(self):
        """TP001-B Tests clicking an image in the front page"""
        print('Testing MMO Row - Landing Page')
        img_1 = self.driver.find_element_by_id('mmo-i1')
        img_2 = self.driver.find_element_by_id('mmo-i2')
        img_3 = self.driver.find_element_by_id('mmo-i3')
        img_4 = self.driver.find_element_by_id('mmo-i4')
        click_button = self.driver.find_element_by_id('mmo-click')

        img_1.click()
        img_2.click()
        img_3.click()
        img_4.click()
        click_button.click()

    def test_rts(self):
        """TP001-C Tests clicking an image in the front page"""
        print('Testing RTS Row - Landing Page')
        img_1 = self.driver.find_element_by_id('rts-i1')
        img_2 = self.driver.find_element_by_id('rts-i2')
        img_3 = self.driver.find_element_by_id('rts-i3')
        img_4 = self.driver.find_element_by_id('rts-i4')
        click_button = self.driver.find_element_by_id('rts-click')

        img_1.click()
        img_2.click()
        img_3.click()
        img_4.click()
        click_button.click()

    def test_login(self):
        """TP002-A Tests successful login"""
        print('Testing Successful Login')
        login_link = self.driver.find_element_by_id('login')
        login_link.click()

        login_area = self.driver.find_element_by_id('username-257')
        password_area = self.driver.find_element_by_id('user_password-257')
        login_button = self.driver.find_element_by_id('um-submit-btn')

        login_area.click()
        login_area.send_keys('test')

        password_area.click()
        password_area.send_keys('Testing1')

        login_button.click()

        current_url = self.driver.current_url
        self.assertEqual(current_url, 'http://game-aid.ca/wp/user/test/',
                         'Should return http://game-aid.ca/wp/user/test/')

    def test_login_false_username(self):
        """TP002-B Tests unsuccessful login with non-existent username"""
        print('Testing Unsuccessful Login with non-existent username')
        login_link = self.driver.find_element_by_id('login')
        login_link.click()

        login_area = self.driver.find_element_by_id('username-257')
        password_area = self.driver.find_element_by_id('user_password-257')
        login_button = self.driver.find_element_by_id('um-submit-btn')

        login_area.click()
        login_area.send_keys('notarealuser')

        password_area.click()
        password_area.send_keys('notarealpassword')

        login_button.click()

        unknown_user_error = self.driver.find_element_by_class_name('um-error-code-invalid_username').text
        self.assertEqual(unknown_user_error, "Unknown username. Check again or try your email address.",
                         'Should return "Unknown username. Check again or try your email address."')

    def test_login_false_password(self):
        """TP002-C Tests unsuccessful login with non-existent username"""
        print('Testing Unsuccessful Login with wrong password.')
        login_link = self.driver.find_element_by_id('login')
        login_link.click()

        login_area = self.driver.find_element_by_id('username-257')
        password_area = self.driver.find_element_by_id('user_password-257')
        login_button = self.driver.find_element_by_id('um-submit-btn')

        login_area.click()
        login_area.send_keys('test')

        password_area.click()
        password_area.send_keys('notarealpassword')

        login_button.click()

        unknown_pass_error = self.driver.find_element_by_class_name('um-field-error').text
        self.assertEqual(unknown_pass_error, "Password is incorrect. Please try again.",
                         'Should return "Password is incorrect. Please try again."')

    def test_loguot(self):
        """TP-003-A Tests successful logout"""
        print('Testing Successful Logout')

        login_link = self.driver.find_element_by_id('login')
        login_link.click()

        login_area = self.driver.find_element_by_id('username-257')
        password_area = self.driver.find_element_by_id('user_password-257')
        login_button = self.driver.find_element_by_id('um-submit-btn')

        login_area.click()
        login_area.send_keys('test')

        password_area.click()
        password_area.send_keys('Testing1')

        login_button.click()

        logout_link = self.driver.find_element_by_link_text('Login')  # Will need to fix this to say 'Logout'
        logout_link.click()
        print('this worked')

        logout_button = self.driver.find_element_by_xpath("//*[contains(text(), 'Logout')]")

        logout_button.click()

        current_url = self.driver.current_url
        self.assertEqual(current_url, 'http://game-aid.ca/wp/login/',
                         'Should return http://game-aid.ca/wp/login/')

        def test_profile(self):
        """TP-004-A Tests profile page for a coach"""
        print('Testing profile information')

        # Navigates to page of interest
        self.driver.find_element_by_id('fps-click').click()
        self.driver.find_element_by_id('fortnite-coaches').click()
        self.driver.find_element_by_id('profile-1').click()

        # Assigns current url after a click and checks if it redirects properly
        current_url = self.driver.current_url
        self.assertEqual(current_url, 'http://game-aid.ca/wp/fn-coach1/',
                         'Should return http://game-aid.ca/wp/fn-coach1/')

        # Assigns variables to web-page elements, found by ID
        coach_name = self.driver.find_element_by_id('coach-name')
        coach_stats = self.driver.find_element_by_id('coach-stats')
        coach_img = self.driver.find_element_by_id('coach-img')

        # Checks if element exists, is a string, as well as the value of the text
        self.assertTrue(coach_name)
        self.assertIsInstance(coach_name.text, str, 'Element should contain a string')
        self.assertEqual(coach_name.text, 'Jaguar "Hackermanz" Perlas',
                         'Should equal "Jaguar "Hackermanz" Perlas"')

        # Checks if element actually exists
        self.assertTrue(coach_stats)
        self.assertTrue(coach_img)


if __name__ == "__main__":
    unittest.main()
