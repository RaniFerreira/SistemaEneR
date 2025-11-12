from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time

# Inicializa o navegador
driver = webdriver.Chrome()
driver.maximize_window()

# Abre sua página de login local
driver.get("http://localhost/sistemaEneR/visao/form_login.php")

# Espera a página carregar
time.sleep(2)

# Localiza os campos de login e senha
email = driver.find_element(By.NAME, "email")
senha = driver.find_element(By.NAME, "senha")

# Digita as credenciais de teste (ajuste conforme seu banco)
email.send_keys("riquinho@gmail.com")
senha.send_keys("12")

# Envia o formulário
senha.send_keys(Keys.RETURN)

# Espera o redirecionamento
time.sleep(3)

# Verifica resultado
url_atual = driver.current_url
print("URL atual:", url_atual)
print("Título da página:", driver.title)


