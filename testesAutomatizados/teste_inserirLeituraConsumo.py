from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

driver = webdriver.Chrome()
driver.maximize_window()
wait = WebDriverWait(driver, 10)

# ==========================================
# 1. Login
# ==========================================
driver.get("http://localhost/sistemaEneR/visao/form_login.php")

wait.until(EC.presence_of_element_located((By.NAME, "email"))).send_keys("felipe@gmail.com")
driver.find_element(By.NAME, "senha").send_keys("12" + Keys.RETURN)

wait.until(EC.url_contains("form_painel_morardor"))
print("✔ Login como morador feito com sucesso!")

time.sleep(1)

# ==========================================
# 2. Acessar Inserir Leitura
# ==========================================
driver.get("http://localhost/sistemaEneR/visao/form_painel_morardor.php?pagina=leitura")
wait.until(EC.presence_of_element_located((By.ID, "kwhInput")))
print("✔ Página de Inserir Leitura carregada!")

# ==========================================
# 3. Preencher leitura
# ==========================================
driver.find_element(By.ID, "kwhInput").send_keys("120.5")
driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()
time.sleep(2)

# ==========================================
# 4. Verificar mensagem
# ==========================================
try:
    msg = wait.until(EC.presence_of_element_located((By.ID, "msgSucesso"))).text
    print("Mensagem:", msg)
    if "sucesso" in msg.lower():
        print("✔ TESTE APROVADO — Leitura registrada com sucesso!")
    else:
        print("⚠ Mensagem exibida, mas não contém sucesso.")
except:
    print("❌ Nenhuma mensagem de sucesso encontrada.")

driver.quit()
