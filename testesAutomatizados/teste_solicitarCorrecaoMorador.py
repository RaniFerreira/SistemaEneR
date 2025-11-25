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
# 2. Acessar Solicitar Correção
# ==========================================
driver.get("http://localhost/sistemaEneR/visao/form_painel_morardor.php?pagina=correcao")
wait.until(EC.presence_of_element_located((By.NAME, "titulo")))
print("✔ Página de Solicitar Correção carregada!")

# ==========================================
# 3. Preencher formulário
# ==========================================
driver.find_element(By.NAME, "titulo").send_keys("Correção via Selenium")
driver.find_element(By.NAME, "descricao").send_keys(
    "Teste automático Selenium.\n"
    "Exemplo: Boleto ID 52, Data 19/11/2025, Valor 145,40 → Solicitação de ajuste."
)

driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()
time.sleep(2)

# ==========================================
# 4. Verificar mensagem
# ==========================================
try:
    msg = wait.until(EC.presence_of_element_located((By.ID, "msgSucesso"))).text
    print("Mensagem exibida:", msg)
    if "sucesso" in msg.lower():
        print("✔ TESTE APROVADO — Correção enviada com sucesso!")
    else:
        print("⚠ Mensagem retornada, mas sem 'sucesso'.")
except:
    print("❌ Nenhuma mensagem de sucesso encontrada.")

driver.quit()
