from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

# ==========================================
# 1. INICIAR O NAVEGADOR
# ==========================================
driver = webdriver.Chrome()
driver.maximize_window()
wait = WebDriverWait(driver, 10)

# ==========================================
# 2. LOGIN COMO SÍNDICO
# ==========================================
driver.get("http://localhost/sistemaEneR/visao/form_login.php")

wait.until(EC.presence_of_element_located((By.NAME, "email"))).send_keys("teste@teste")
driver.find_element(By.NAME, "senha").send_keys("12" + Keys.RETURN)

wait.until(EC.url_contains("painel_sindico"))
print("✔ Login realizado com sucesso!")

time.sleep(1)

# ==========================================
# 3. ACESSAR PÁGINA DE SOLICITAR CORREÇÃO
# ==========================================
driver.get("http://localhost/sistemaEneR/visao/form_painel_sindico.php?pagina=correcao")

wait.until(EC.presence_of_element_located((By.NAME, "titulo")))
print("✔ Página de solicitação de correção carregada!")

# ==========================================
# 4. PREENCHER FORMULÁRIO
# ==========================================
driver.find_element(By.NAME, "titulo").send_keys("Correção teste Selenium")
driver.find_element(By.NAME, "descricao").send_keys(
    "Descrição automática via Selenium.\n"
    "Solicitação de correção de teste.\n"
    "Exemplo: Boleto ID 49, Data 19/11/2025, Valor 148,50."
)

# ==========================================
# 5. ENVIAR SOLICITAÇÃO
# ==========================================
driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()
time.sleep(2)

# ==========================================
# 6. VERIFICAR RESULTADO
# ==========================================
print("\n==================== RESULTADO ====================")

try:
    msg = wait.until(EC.presence_of_element_located((By.ID, "msgSucesso"))).text
    print("Mensagem exibida:", msg)

    if "sucesso" in msg.lower():
        print("✔ TESTE APROVADO — Solicitação enviada com sucesso!")
    else:
        print("⚠ TESTE FINALIZADO — Mensagem retornada, mas não contém 'sucesso'.")

except Exception:
    print("❌ Nenhuma mensagem de sucesso encontrada. Possível falha no envio.")

print("===================================================\n")

# ==========================================
# 7. FINALIZAR
# ==========================================
time.sleep(2)
driver.quit()
