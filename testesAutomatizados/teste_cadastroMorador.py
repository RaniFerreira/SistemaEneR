from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time


# 1. INICIAR O NAVEGADOR

driver = webdriver.Chrome()
driver.maximize_window()

wait = WebDriverWait(driver, 10)

# 2. LOGIN COMO SÍNDICO

driver.get("http://localhost/sistemaEneR/visao/form_login.php")

# Preencher login
wait.until(EC.presence_of_element_located((By.NAME, "email"))).send_keys("teste_selenium_1763353180@gmail.com")
driver.find_element(By.NAME, "senha").send_keys("senha123" + Keys.RETURN)

# Aguardar login completar
wait.until(EC.url_contains("painel_sindico"))
print("✔ Login realizado com sucesso!")

time.sleep(1)

# 3. IR PARA PÁGINA DE CADASTRAR MORADOR

driver.get("http://localhost/sistemaEneR/visao/form_painel_sindico.php?pagina=cadastrar_morador")

wait.until(EC.presence_of_element_located((By.ID, "nome_usuario")))
print("✔ Página de cadastro de morador carregada!")

# 4. PREENCHER FORMULÁRIO DE MORADOR

driver.find_element(By.ID, "nome_usuario").send_keys("usuarioMoradorTeste")
driver.find_element(By.ID, "email").send_keys("morador_teste_selenium@example.com")
driver.find_element(By.ID, "senha").send_keys("123456")

driver.find_element(By.ID, "nome_morador").send_keys("Morador Teste Selenium")
driver.find_element(By.ID, "telefone").send_keys("(11) 91234-5678")
driver.find_element(By.ID, "condominio").send_keys("Condomínio Teste Selenium")

# 5. ENVIAR FORMULÁRIO

driver.find_element(By.CSS_SELECTOR, "input[type='submit']").click()
time.sleep(2)

# 6. VERIFICAR RESULTADO

print("\n==================== RESULTADO ====================")

try:
    mensagem = driver.find_element(By.TAG_NAME, "p").text
    print("Mensagem exibida:", mensagem)

    if "sucesso" in mensagem.lower():
        print("✔ TESTE APROVADO — Morador cadastrado!")
    else:
        print("⚠ TESTE FINALIZADO — Mensagem recebida, mas não foi sucesso.")

except Exception:
    print("❌ Nenhuma mensagem encontrada. Página pode ter falhado.")

print("===================================================\n")

# 7. FINALIZAR

time.sleep(2)
driver.quit()
