from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time

# Inicia o navegador
driver = webdriver.Chrome()
driver.maximize_window()

# Abre a página de cadastro
driver.get("http://localhost/sistemaEneR/visao/form_cadastro_sindico.php")

time.sleep(2)

# Preenche os campos
driver.find_element(By.NAME, "nome_usuario").send_keys("Teste Selenium")
driver.find_element(By.NAME, "email").send_keys("teste_selenium_" + str(int(time.time())) + "@gmail.com")
driver.find_element(By.NAME, "senha").send_keys("senha123")

driver.find_element(By.NAME, "nome_sindico").send_keys("Síndico de Teste")
driver.find_element(By.NAME, "telefone").send_keys("(11) 98888-8888")
driver.find_element(By.NAME, "condominio").send_keys("Condomínio de Teste")

# Envia o formulário (pressionando Enter no último campo)
driver.find_element(By.NAME, "condominio").send_keys(Keys.RETURN)

time.sleep(3)

# Mostra onde caiu depois do cadastro
print("URL atual:", driver.current_url)
print("Título da página:", driver.title)

# Fecha o navegador
driver.quit()
