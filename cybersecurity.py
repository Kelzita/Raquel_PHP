import tkinter as tk
from tkinter import ttk, messagebox, filedialog
import hashlib
import socket
import random
import string
import threading
import os
import json
import requests
from PIL import Image, ImageTk
from cryptography.fernet import Fernet
from datetime import datetime
import exifread

class AdvancedCyberSecurityTool:
    def __init__(self, root):
        self.root = root
        self.root.title("Cyber Security Suite Pro")
        self.root.geometry("1000x700")
        self.root.minsize(900, 600)
        
        # Configurar tema escuro
        self.set_dark_theme()
        
        # Barra de status
        self.status_var = tk.StringVar()
        self.status_bar = ttk.Label(root, textvariable=self.status_var, relief=tk.SUNKEN, anchor=tk.W)
        self.status_bar.pack(side=tk.BOTTOM, fill=tk.X)
        self.update_status("Pronto")
        
        # Cabeçalho
        self.create_header()
        
        # Notebook (abas)
        self.notebook = ttk.Notebook(root)
        self.notebook.pack(fill='both', expand=True, padx=10, pady=(0, 10))
        
        # Criar todas as abas
        self.create_password_tools_tab()
        self.create_network_tools_tab()
        self.create_crypto_tools_tab()
        self.create_metadata_tools_tab()
        self.create_hash_tools_tab()
        
        # Carregar dados de senhas vazadas (simplificado)
        self.breached_passwords = self.load_breached_passwords()
    
    def set_dark_theme(self):
        """Configura um tema escuro moderno para a aplicação"""
        self.root.tk_setPalette(
            background='#2e2e2e',
            foreground='#ffffff',
            activeBackground='#3e3e3e',
            activeForeground='#ffffff'
        )
        
        style = ttk.Style()
        style.theme_use('clam')
        
        # Configurar cores do tema
        style.configure('.', background='#2e2e2e', foreground='#ffffff')
        style.configure('TNotebook', background='#2e2e2e', borderwidth=0)
        style.configure('TNotebook.Tab', background='#3e3e3e', foreground='#ffffff', padding=[10, 5])
        style.map('TNotebook.Tab', background=[('selected', '#1e1e1e')])
        style.configure('TFrame', background='#2e2e2e')
        style.configure('TLabel', background='#2e2e2e', foreground='#ffffff')
        style.configure('TEntry', fieldbackground='#3e3e3e', foreground='#ffffff')
        style.configure('TButton', background='#3e3e3e', foreground='#ffffff')
        style.map('TButton', background=[('active', '#4e4e4e')])
        style.configure('Vertical.TScrollbar', background='#3e3e3e', troughcolor='#2e2e2e')
        style.configure('Horizontal.TScrollbar', background='#3e3e3e', troughcolor='#2e2e2e')
    
    def create_header(self):
        """Cria o cabeçalho da aplicação com logo e título"""
        header_frame = ttk.Frame(self.root)
        header_frame.pack(fill=tk.X, padx=10, pady=10)
        
        # Logo (usando texto como substituto)
        logo_label = ttk.Label(header_frame, text="🛡️", font=('Arial', 24))
        logo_label.pack(side=tk.LEFT, padx=(0, 10))
        
        # Título
        title_label = ttk.Label(
            header_frame, 
            text="Cyber Security Suite Pro", 
            font=('Arial', 16, 'bold'),
            foreground='#4fc3f7'
        )
        title_label.pack(side=tk.LEFT)
        
        # Versão
        version_label = ttk.Label(
            header_frame, 
            text="v2.0", 
            font=('Arial', 10),
            foreground='#bdbdbd'
        )
        version_label.pack(side=tk.LEFT, padx=(10, 0))
    
    def update_status(self, message):
        """Atualiza a barra de status"""
        timestamp = datetime.now().strftime("%H:%M:%S")
        self.status_var.set(f"[{timestamp}] {message}")
    
    # ==============================================
    # ABA: FERRAMENTAS DE SENHA
    # ==============================================
    def create_password_tools_tab(self):
        tab = ttk.Frame(self.notebook)
        self.notebook.add(tab, text="Ferramentas de Senha")
        
        # Painel esquerdo - Verificador de senha
        left_panel = ttk.Frame(tab)
        left_panel.pack(side=tk.LEFT, fill=tk.BOTH, expand=True, padx=5, pady=5)
        
        checker_frame = ttk.LabelFrame(left_panel, text="Verificador de Senha", padding=10)
        checker_frame.pack(fill=tk.BOTH, expand=True)
        
        ttk.Label(checker_frame, text="Digite uma senha para verificar:").pack(pady=(0, 5))
        
        self.password_entry = ttk.Entry(checker_frame, show="•", width=30)
        self.password_entry.pack(pady=5)
        
        check_btn = ttk.Button(
            checker_frame, 
            text="Verificar Força", 
            command=self.check_password_strength,
            style='Accent.TButton'
        )
        check_btn.pack(pady=10)
        
        self.strength_meter = ttk.Progressbar(checker_frame, orient='horizontal', length=200, mode='determinate')
        self.strength_meter.pack(pady=5)
        
        self.strength_label = ttk.Label(checker_frame, text="", font=('Arial', 11))
        self.strength_label.pack(pady=5)
        
        self.suggestions_text = tk.Text(
            checker_frame, 
            height=6, 
            width=40, 
            wrap=tk.WORD, 
            bg='#3e3e3e', 
            fg='#ffffff',
            insertbackground='white'
        )
        self.suggestions_text.pack(pady=5)
        self.suggestions_text.insert(tk.END, "Sugestões aparecerão aqui...")
        self.suggestions_text.config(state=tk.DISABLED)
        
        # Painel direito - Gerador de senha
        right_panel = ttk.Frame(tab)
        right_panel.pack(side=tk.LEFT, fill=tk.BOTH, expand=True, padx=5, pady=5)
        
        generator_frame = ttk.LabelFrame(right_panel, text="Gerador de Senha Segura", padding=10)
        generator_frame.pack(fill=tk.BOTH, expand=True)
        
        ttk.Label(generator_frame, text="Tamanho da senha:").pack(pady=(0, 5))
        
        self.length_var = tk.IntVar(value=16)
        length_frame = ttk.Frame(generator_frame)
        length_frame.pack(pady=5)
        ttk.Label(length_frame, text="8").pack(side=tk.LEFT)
        ttk.Scale(
            length_frame, 
            from_=8, 
            to=32, 
            variable=self.length_var,
            orient=tk.HORIZONTAL,
            length=150
        ).pack(side=tk.LEFT, padx=5)
        ttk.Label(length_frame, text="32").pack(side=tk.LEFT)
        ttk.Label(length_frame, textvariable=self.length_var).pack(side=tk.LEFT, padx=5)
        
        # Opções de caracteres
        self.include_upper = tk.BooleanVar(value=True)
        ttk.Checkbutton(
            generator_frame, 
            text="Letras maiúsculas (A-Z)", 
            variable=self.include_upper
        ).pack(anchor='w', pady=2)
        
        self.include_lower = tk.BooleanVar(value=True)
        ttk.Checkbutton(
            generator_frame, 
            text="Letras minúsculas (a-z)", 
            variable=self.include_lower
        ).pack(anchor='w', pady=2)
        
        self.include_digits = tk.BooleanVar(value=True)
        ttk.Checkbutton(
            generator_frame, 
            text="Números (0-9)", 
            variable=self.include_digits
        ).pack(anchor='w', pady=2)
        
        self.include_special = tk.BooleanVar(value=True)
        ttk.Checkbutton(
            generator_frame, 
            text="Caracteres especiais (!@#$)", 
            variable=self.include_special
        ).pack(anchor='w', pady=2)
        
        generate_btn = ttk.Button(
            generator_frame, 
            text="Gerar Senha", 
            command=self.generate_password,
            style='Accent.TButton'
        )
        generate_btn.pack(pady=15)
        
        self.generated_password = ttk.Entry(
            generator_frame, 
            width=30, 
            font=('Arial', 12),
            justify='center'
        )
        self.generated_password.pack(pady=5)
        
        btn_frame = ttk.Frame(generator_frame)
        btn_frame.pack(pady=5)
        
        ttk.Button(
            btn_frame, 
            text="Copiar", 
            command=self.copy_password,
            width=8
        ).pack(side=tk.LEFT, padx=5)
        
        ttk.Button(
            btn_frame, 
            text="Verificar", 
            command=self.check_generated_password,
            width=8
        ).pack(side=tk.LEFT, padx=5)
    
    def check_password_strength(self):
        password = self.password_entry.get()
        if not password:
            messagebox.showwarning("Aviso", "Por favor, digite uma senha.")
            return
        
        # Verificar se a senha foi vazada
        is_breached = self.check_password_breach(password)
        
        strength = 0
        suggestions = []
        
        # Verifica o comprimento
        if len(password) >= 16:
            strength += 3
        elif len(password) >= 12:
            strength += 2
        elif len(password) >= 8:
            strength += 1
        else:
            suggestions.append("🔸 Use pelo menos 12 caracteres (16+ recomendado)")
        
        # Verifica se tem dígitos
        if any(c.isdigit() for c in password):
            strength += 1
        else:
            suggestions.append("🔸 Adicione números para aumentar a segurança")
        
        # Verifica se tem letras maiúsculas e minúsculas
        upper = any(c.isupper() for c in password)
        lower = any(c.islower() for c in password)
        
        if upper and lower:
            strength += 1
        else:
            suggestions.append("🔸 Use uma mistura de letras maiúsculas e minúsculas")
        
        # Verifica caracteres especiais
        if any(c in string.punctuation for c in password):
            strength += 1
        else:
            suggestions.append("🔸 Adicione caracteres especiais (!@#$%^&*)")
        
        # Verifica sequências comuns
        common_sequences = [
            "123", "abc", "qwerty", "password", "asdf", "0000", 
            "1111", "admin", "welcome", "senha", "123456"
        ]
        
        if any(seq in password.lower() for seq in common_sequences):
            strength = max(0, strength - 2)
            suggestions.append("🔸 Evite sequências comuns e palavras simples")
        
        # Verifica repetição
        if len(set(password)) < len(password) / 2:
            strength = max(0, strength - 1)
            suggestions.append("🔸 Evite muitos caracteres repetidos")
        
        # Ajusta para escala 0-100
        strength_score = min(100, (strength / 7) * 100)
        self.strength_meter['value'] = strength_score
        
        # Exibe o resultado
        if is_breached:
            self.strength_label.config(text="SENHA VAZADA - NÃO USE!", foreground='#ff5252')
            suggestions.insert(0, "🚨 ESTA SENHA FOI ENCONTRADA EM VAZAMENTOS DE DADOS!")
        elif strength_score >= 80:
            self.strength_label.config(text="Senha Excelente", foreground='#4caf50')
        elif strength_score >= 60:
            self.strength_label.config(text="Senha Boa", foreground='#8bc34a')
        elif strength_score >= 40:
            self.strength_label.config(text="Senha Razoável", foreground='#ffc107')
        elif strength_score >= 20:
            self.strength_label.config(text="Senha Fraca", foreground='#ff9800')
        else:
            self.strength_label.config(text="Senha Muito Fraca", foreground='#ff5252')
        
        # Mostra sugestões
        self.suggestions_text.config(state=tk.NORMAL)
        self.suggestions_text.delete(1.0, tk.END)
        
        if not suggestions:
            self.suggestions_text.insert(tk.END, "✅ Sua senha atende aos critérios básicos de segurança!")
        else:
            self.suggestions_text.insert(tk.END, "\n".join(suggestions))
        
        self.suggestions_text.config(state=tk.DISABLED)
        self.update_status("Verificação de senha concluída")
    
    def check_password_breach(self, password):
        """Verifica se a senha foi vazada (versão simplificada)"""
        # Nota: Em uma aplicação real, isso seria feito com uma API ou banco de dados local
        # Aqui estamos usando uma lista pequena de senhas comuns apenas para demonstração
        password_hash = hashlib.sha1(password.encode('utf-8')).hexdigest().upper()
        prefix = password_hash[:5]
        
        # Verifica no dicionário de senhas vazadas
        if password in self.breached_passwords:
            return True
        
        return False
    
    def load_breached_passwords(self):
        """Carrega uma lista de senhas vazadas (simplificado para demonstração)"""
        common_passwords = [
            "123456", "password", "123456789", "12345678", "12345",
            "1234567", "1234567890", "qwerty", "abc123", "senha",
            "password1", "1234", "iloveyou", "111111", "000000"
        ]
        return set(common_passwords)
    
    def generate_password(self):
        length = self.length_var.get()
        chars = ''
        
        if self.include_upper.get():
            chars += string.ascii_uppercase
        if self.include_lower.get():
            chars += string.ascii_lowercase
        if self.include_digits.get():
            chars += string.digits
        if self.include_special.get():
            chars += string.punctuation
        
        if not chars:
            messagebox.showerror("Erro", "Selecione pelo menos um tipo de caractere.")
            return
        
        # Garante que pelo menos um caractere de cada tipo selecionado seja incluído
        password = []
        if self.include_upper.get():
            password.append(random.choice(string.ascii_uppercase))
        if self.include_lower.get():
            password.append(random.choice(string.ascii_lowercase))
        if self.include_digits.get():
            password.append(random.choice(string.digits))
        if self.include_special.get():
            password.append(random.choice(string.punctuation))
        
        # Preenche o resto da senha
        remaining_length = length - len(password)
        password.extend(random.choice(chars) for _ in range(remaining_length))
        
        # Embaralha a senha
        random.shuffle(password)
        password = ''.join(password)
        
        self.generated_password.delete(0, tk.END)
        self.generated_password.insert(0, password)
        self.update_status("Senha gerada com sucesso")
    
    def copy_password(self):
        password = self.generated_password.get()
        if password:
            self.root.clipboard_clear()
            self.root.clipboard_append(password)
            self.update_status("Senha copiada para a área de transferência")
        else:
            messagebox.showwarning("Aviso", "Nenhuma senha gerada para copiar.")
    
    def check_generated_password(self):
        password = self.generated_password.get()
        if password:
            self.password_entry.delete(0, tk.END)
            self.password_entry.insert(0, password)
            self.check_password_strength()
        else:
            messagebox.showwarning("Aviso", "Nenhuma senha gerada para verificar.")
    
    # ==============================================
    # ABA: FERRAMENTAS DE REDE
    # ==============================================
    def create_network_tools_tab(self):
        tab = ttk.Frame(self.notebook)
        self.notebook.add(tab, text="Ferramentas de Rede")
        
        # Scanner de portas
        port_scanner_frame = ttk.LabelFrame(tab, text="Scanner de Portas Avançado", padding=10)
        port_scanner_frame.pack(fill=tk.BOTH, expand=True, padx=5, pady=5)
        
        # Configuração do scan
        config_frame = ttk.Frame(port_scanner_frame)
        config_frame.pack(fill=tk.X, pady=5)
        
        ttk.Label(config_frame, text="Alvo:").grid(row=0, column=0, padx=5, sticky='e')
        self.host_entry = ttk.Entry(config_frame, width=25)
        self.host_entry.grid(row=0, column=1, sticky='we')
        self.host_entry.insert(0, "localhost")
        
        ttk.Label(config_frame, text="Portas:").grid(row=0, column=2, padx=5, sticky='e')
        self.ports_entry = ttk.Entry(config_frame, width=25)
        self.ports_entry.grid(row=0, column=3, sticky='we')
        self.ports_entry.insert(0, "1-1024")
        
        ttk.Label(config_frame, text="Threads:").grid(row=0, column=4, padx=5, sticky='e')
        self.threads_var = tk.IntVar(value=50)
        ttk.Spinbox(
            config_frame, 
            from_=1, 
            to=200, 
            textvariable=self.threads_var,
            width=5
        ).grid(row=0, column=5, sticky='w')
        
        # Botões de ação
        btn_frame = ttk.Frame(port_scanner_frame)
        btn_frame.pack(pady=5)
        
        ttk.Button(
            btn_frame, 
            text="Iniciar Scan", 
            command=self.start_scan,
            style='Accent.TButton'
        ).pack(side=tk.LEFT, padx=5)
        
        ttk.Button(
            btn_frame, 
            text="Parar Scan", 
            command=self.stop_scan,
            state=tk.DISABLED
        ).pack(side=tk.LEFT, padx=5)
        
        ttk.Button(
            btn_frame, 
            text="Limpar", 
            command=self.clear_scan_results
        ).pack(side=tk.LEFT, padx=5)
        
        # Resultados
        results_frame = ttk.Frame(port_scanner_frame)
        results_frame.pack(fill=tk.BOTH, expand=True)
        
        # Treeview para mostrar resultados
        self.results_tree = ttk.Treeview(
            results_frame,
            columns=('port', 'status', 'service'),
            show='headings',
            height=10
        )
        
        self.results_tree.heading('port', text='Porta')
        self.results_tree.heading('status', text='Status')
        self.results_tree.heading('service', text='Serviço')
        
        self.results_tree.column('port', width=80, anchor='center')
        self.results_tree.column('status', width=100, anchor='center')
        self.results_tree.column('service', width=200, anchor='center')
        
        scrollbar = ttk.Scrollbar(results_frame, orient=tk.VERTICAL, command=self.results_tree.yview)
        self.results_tree.configure(yscroll=scrollbar.set)
        
        self.results_tree.pack(side=tk.LEFT, fill=tk.BOTH, expand=True)
        scrollbar.pack(side=tk.RIGHT, fill=tk.Y)
        
        # Status do scan
        self.scan_status_var = tk.StringVar(value="Pronto para escanear")
        ttk.Label(
            port_scanner_frame,
            textvariable=self.scan_status_var,
            foreground='#bdbdbd'
        ).pack(pady=(5, 0))
        
        # Variáveis para controle do scan
        self.scan_active = False
        self.scan_threads = []
    
    def start_scan(self):
        host = self.host_entry.get()
        ports = self.ports_entry.get()
        threads = self.threads_var.get()
        
        if not host or not ports:
            messagebox.showwarning("Aviso", "Por favor, preencha todos os campos.")
            return
        
        try:
            # Verifica se é um intervalo de portas
            if '-' in ports:
                start_port, end_port = map(int, ports.split('-'))
                ports_to_scan = list(range(start_port, end_port + 1))
            else:
                ports_to_scan = [int(ports)]
            
            # Limpa resultados anteriores
            self.results_tree.delete(*self.results_tree.get_children())
            
            # Configura estado do scan
            self.scan_active = True
            self.scan_status_var.set(f"Escaneando {host}...")
            self.update_status(f"Iniciando scan em {host} (portas: {ports})")
            
            # Divide as portas em chunks para cada thread
            chunk_size = len(ports_to_scan) // threads + 1
            port_chunks = [ports_to_scan[i:i + chunk_size] for i in range(0, len(ports_to_scan), chunk_size)]
            
            # Cria e inicia as threads
            for chunk in port_chunks:
                thread = threading.Thread(
                    target=self.scan_ports_thread,
                    args=(host, chunk),
                    daemon=True
                )
                self.scan_threads.append(thread)
                thread.start()
            
        except ValueError:
            messagebox.showerror("Erro", "Formato de portas inválido. Use '80' ou '20-80'.")
        except Exception as e:
            messagebox.showerror("Erro", f"Ocorreu um erro: {str(e)}")
    
    def scan_ports_thread(self, host, ports):
        """Função executada por cada thread para escanear portas"""
        for port in ports:
            if not self.scan_active:
                break
            
            try:
                sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
                sock.settimeout(1)
                result = sock.connect_ex((host, port))
                
                if result == 0:
                    try:
                        service = socket.getservbyport(port, 'tcp')
                    except:
                        service = "desconhecido"
                    
                    # Atualiza a interface na thread principal
                    self.root.after(0, self.add_scan_result, port, "Aberta", service)
                sock.close()
            except:
                continue
    
    def add_scan_result(self, port, status, service):
        """Adiciona um resultado ao Treeview"""
        self.results_tree.insert(
            '', 
            tk.END, 
            values=(port, status, service)
        )
    
    def stop_scan(self):
        """Para o scan em andamento"""
        self.scan_active = False
        self.scan_status_var.set("Scan interrompido")
        self.update_status("Scan de portas interrompido")
    
    def clear_scan_results(self):
        """Limpa os resultados do scan"""
        self.results_tree.delete(*self.results_tree.get_children())
        self.scan_status_var.set("Pronto para escanear")
    
    # ==============================================
    # ABA: FERRAMENTAS DE CRIPTOGRAFIA
    # ==============================================
    def create_crypto_tools_tab(self):
        tab = ttk.Frame(self.notebook)
        self.notebook.add(tab, text="Criptografia")
        
        # Notebook interno para diferentes operações
        crypto_notebook = ttk.Notebook(tab)
        crypto_notebook.pack(fill=tk.BOTH, expand=True, padx=5, pady=5)
        
        # Aba de criptografia simétrica
        self.create_symmetric_crypto_tab(crypto_notebook)
        
        # Aba de geração de chaves
        self.create_keygen_tab(crypto_notebook)
    
    def create_symmetric_crypto_tab(self, notebook):
        tab = ttk.Frame(notebook)
        notebook.add(tab, text="Criptografia Simétrica")
        
        # Seleção de arquivo
        file_frame = ttk.LabelFrame(tab, text="Arquivo", padding=10)
        file_frame.pack(fill=tk.X, padx=5, pady=5)
        
        ttk.Button(
            file_frame,
            text="Selecionar Arquivo",
            command=self.select_crypto_file
        ).pack(pady=5)
        
        self.crypto_file_path = tk.StringVar()
        ttk.Label(
            file_frame,
            textvariable=self.crypto_file_path,
            wraplength=400,
            foreground='#bdbdbd'
        ).pack(pady=5)
        
        # Chave de criptografia
        key_frame = ttk.LabelFrame(tab, text="Chave", padding=10)
        key_frame.pack(fill=tk.X, padx=5, pady=5)
        
        ttk.Label(key_frame, text="Chave (32 bytes em base64):").pack(pady=(0, 5))
        
        self.crypto_key_entry = ttk.Entry(key_frame, width=50)
        self.crypto_key_entry.pack(pady=5)
        
        ttk.Button(
            key_frame,
            text="Gerar Chave",
            command=self.generate_crypto_key
        ).pack(pady=5)
        
        # Operações
        ops_frame = ttk.Frame(tab)
        ops_frame.pack(pady=10)
        
        ttk.Button(
            ops_frame,
            text="Criptografar",
            command=self.encrypt_file,
            style='Accent.TButton'
        ).pack(side=tk.LEFT, padx=10)
        
        ttk.Button(
            ops_frame,
            text="Descriptografar",
            command=self.decrypt_file
        ).pack(side=tk.LEFT, padx=10)
    
    def select_crypto_file(self):
        """Seleciona um arquivo para criptografia/descriptografia"""
        filepath = filedialog.askopenfilename()
        if filepath:
            self.crypto_file_path.set(filepath)
            self.update_status(f"Arquivo selecionado: {filepath}")
    
    def generate_crypto_key(self):
        """Gera uma chave de criptografia aleatória"""
        key = Fernet.generate_key()
        self.crypto_key_entry.delete(0, tk.END)
        self.crypto_key_entry.insert(0, key.decode())
        self.update_status("Chave de criptografia gerada")
    
    def encrypt_file(self):
        """Criptografa o arquivo selecionado"""
        filepath = self.crypto_file_path.get()
        key = self.crypto_key_entry.get()
        
        if not filepath or not key:
            messagebox.showwarning("Aviso", "Selecione um arquivo e insira uma chave.")
            return
        
        try:
            fernet = Fernet(key.encode())
            
            with open(filepath, 'rb') as f:
                data = f.read()
            
            encrypted_data = fernet.encrypt(data)
            
            save_path = filedialog.asksaveasfilename(
                defaultextension=".enc",
                initialfile=os.path.basename(filepath) + ".enc"
            )
            
            if save_path:
                with open(save_path, 'wb') as f:
                    f.write(encrypted_data)
                
                messagebox.showinfo("Sucesso", "Arquivo criptografado com sucesso!")
                self.update_status(f"Arquivo criptografado salvo em: {save_path}")
        
        except Exception as e:
            messagebox.showerror("Erro", f"Falha ao criptografar: {str(e)}")
    
    def decrypt_file(self):
        """Descriptografa o arquivo selecionado"""
        filepath = self.crypto_file_path.get()
        key = self.crypto_key_entry.get()
        
        if not filepath or not key:
            messagebox.showwarning("Aviso", "Selecione um arquivo e insira uma chave.")
            return
        
        try:
            fernet = Fernet(key.encode())
            
            with open(filepath, 'rb') as f:
                encrypted_data = f.read()
            
            decrypted_data = fernet.decrypt(encrypted_data)
            
            save_path = filedialog.asksaveasfilename(
                initialfile=os.path.basename(filepath).replace('.enc', '')
            )
            
            if save_path:
                with open(save_path, 'wb') as f:
                    f.write(decrypted_data)
                
                messagebox.showinfo("Sucesso", "Arquivo descriptografado com sucesso!")
                self.update_status(f"Arquivo descriptografado salvo em: {save_path}")
        
        except Exception as e:
            messagebox.showerror("Erro", f"Falha ao descriptografar: {str(e)}")
    
    def create_keygen_tab(self, notebook):
        tab = ttk.Frame(notebook)
        notebook.add(tab, text="Gerador de Chaves")
        
        ttk.Label(tab, text="Selecione o tipo de chave:").pack(pady=10)
        
        key_type = tk.StringVar(value='fernet')
        
        ttk.Radiobutton(
            tab,
            text="Fernet (AES-128)",
            variable=key_type,
            value='fernet'
        ).pack(anchor='w', padx=50, pady=5)
        
        ttk.Radiobutton(
            tab,
            text="RSA (2048 bits)",
            variable=key_type,
            value='rsa'
        ).pack(anchor='w', padx=50, pady=5)
        
        ttk.Button(
            tab,
            text="Gerar Chave",
            command=lambda: self.generate_key(key_type.get()),
            style='Accent.TButton'
        ).pack(pady=20)
        
        self.key_text = tk.Text(
            tab,
            height=10,
            width=70,
            wrap=tk.WORD,
            bg='#3e3e3e',
            fg='#ffffff',
            insertbackground='white'
        )
        self.key_text.pack(pady=10, padx=10)
        self.key_text.insert(tk.END, "A chave gerada aparecerá aqui...")
        
        ttk.Button(
            tab,
            text="Copiar Chave",
            command=self.copy_key
        ).pack(pady=5)
    
    def generate_key(self, key_type):
        """Gera uma chave criptográfica"""
        try:
            if key_type == 'fernet':
                key = Fernet.generate_key().decode()
                self.key_text.delete(1.0, tk.END)
                self.key_text.insert(tk.END, key)
                self.update_status("Chave Fernet gerada")
            
            elif key_type == 'rsa':
                # Em uma aplicação real, usaria cryptography.hazmat.primitives.asymmetric.rsa
                # Aqui é apenas um placeholder para demonstração
                self.key_text.delete(1.0, tk.END)
                self.key_text.insert(tk.END, "Funcionalidade RSA não implementada nesta demonstração.")
                self.update_status("Geração de chave RSA não implementada")
        
        except Exception as e:
            messagebox.showerror("Erro", f"Falha ao gerar chave: {str(e)}")
    
    def copy_key(self):
        """Copia a chave gerada para a área de transferência"""
        key = self.key_text.get(1.0, tk.END).strip()
        if key and key != "A chave gerada aparecerá aqui...":
            self.root.clipboard_clear()
            self.root.clipboard_append(key)
            self.update_status("Chave copiada para a área de transferência")
        else:
            messagebox.showwarning("Aviso", "Nenhuma chave gerada para copiar.")
    
    # ==============================================
    # ABA: FERRAMENTAS DE METADADOS
    # ==============================================
    def create_metadata_tools_tab(self):
        tab = ttk.Frame(self.notebook)
        self.notebook.add(tab, text="Análise de Metadados")
        
        # Seleção de arquivo
        file_frame = ttk.LabelFrame(tab, text="Selecionar Arquivo", padding=10)
        file_frame.pack(fill=tk.X, padx=5, pady=5)
        
        ttk.Button(
            file_frame,
            text="Selecionar Arquivo",
            command=self.select_metadata_file,
            style='Accent.TButton'
        ).pack(pady=5)
        
        self.metadata_file_path = tk.StringVar()
        ttk.Label(
            file_frame,
            textvariable=self.metadata_file_path,
            wraplength=500,
            foreground='#bdbdbd'
        ).pack(pady=5)
        
        # Resultados
        results_frame = ttk.LabelFrame(tab, text="Metadados Extraídos", padding=10)
        results_frame.pack(fill=tk.BOTH, expand=True, padx=5, pady=5)
        
        self.metadata_text = tk.Text(
            results_frame,
            height=15,
            width=80,
            wrap=tk.WORD,
            bg='#3e3e3e',
            fg='#ffffff',
            insertbackground='white'
        )
        
        scrollbar = ttk.Scrollbar(
            results_frame,
            orient=tk.VERTICAL,
            command=self.metadata_text.yview
        )
        self.metadata_text.configure(yscroll=scrollbar.set)
        
        self.metadata_text.pack(side=tk.LEFT, fill=tk.BOTH, expand=True)
        scrollbar.pack(side=tk.RIGHT, fill=tk.Y)
        
        self.metadata_text.insert(tk.END, "Metadados aparecerão aqui após selecionar um arquivo.")
        self.metadata_text.config(state=tk.DISABLED)
    
    def select_metadata_file(self):
        """Seleciona um arquivo para análise de metadados"""
        filepath = filedialog.askopenfilename()
        if filepath:
            self.metadata_file_path.set(filepath)
            self.analyze_metadata(filepath)
    
    def analyze_metadata(self, filepath):
        """Analisa os metadados do arquivo selecionado"""
        try:
            self.metadata_text.config(state=tk.NORMAL)
            self.metadata_text.delete(1.0, tk.END)
            
            # Informações básicas do arquivo
            file_stats = os.stat(filepath)
            self.metadata_text.insert(tk.END, "=== Informações Básicas ===\n")
            self.metadata_text.insert(tk.END, f"Nome: {os.path.basename(filepath)}\n")
            self.metadata_text.insert(tk.END, f"Tamanho: {file_stats.st_size} bytes\n")
            self.metadata_text.insert(tk.END, f"Criado em: {datetime.fromtimestamp(file_stats.st_ctime)}\n")
            self.metadata_text.insert(tk.END, f"Modificado em: {datetime.fromtimestamp(file_stats.st_mtime)}\n")
            self.metadata_text.insert(tk.END, f"Acessado em: {datetime.fromtimestamp(file_stats.st_atime)}\n\n")
            
            # Metadados específicos para imagens
            if filepath.lower().endswith(('.jpg', '.jpeg', '.png', '.tiff')):
                self.metadata_text.insert(tk.END, "=== Metadados de Imagem ===\n")
                
                with open(filepath, 'rb') as f:
                    tags = exifread.process_file(f)
                
                if not tags:
                    self.metadata_text.insert(tk.END, "Nenhum metadado EXIF encontrado.\n")
                else:
                    for tag, value in tags.items():
                        if tag not in ('JPEGThumbnail', 'TIFFThumbnail', 'Filename', 'EXIF MakerNote'):
                            self.metadata_text.insert(tk.END, f"{tag}: {value}\n")
            
            # Metadados para PDFs (simplificado)
            elif filepath.lower().endswith('.pdf'):
                self.metadata_text.insert(tk.END, "=== Metadados PDF ===\n")
                self.metadata_text.insert(tk.END, "Análise de PDF não implementada nesta versão.\n")
            
            else:
                self.metadata_text.insert(tk.END, "=== Metadados Específicos ===\n")
                self.metadata_text.insert(tk.END, "Tipo de arquivo não suportado para análise detalhada.\n")
            
            self.metadata_text.config(state=tk.DISABLED)
            self.update_status(f"Metadados analisados para: {filepath}")
        
        except Exception as e:
            self.metadata_text.insert(tk.END, f"\nErro ao analisar metadados: {str(e)}")
            self.metadata_text.config(state=tk.DISABLED)
            self.update_status(f"Erro ao analisar metadados: {str(e)}")
    
    # ==============================================
    # ABA: FERRAMENTAS DE HASH
    # ==============================================
    def create_hash_tools_tab(self):
        tab = ttk.Frame(self.notebook)
        self.notebook.add(tab, text="Ferramentas de Hash")
        
        # Notebook interno para diferentes operações
        hash_notebook = ttk.Notebook(tab)
        hash_notebook.pack(fill=tk.BOTH, expand=True, padx=5, pady=5)
        
        # Aba de hash de texto
        self.create_text_hash_tab(hash_notebook)
        
        # Aba de hash de arquivo
        self.create_file_hash_tab(hash_notebook)
    
    def create_text_hash_tab(self, notebook):
        tab = ttk.Frame(notebook)
        notebook.add(tab, text="Hash de Texto")
        
        ttk.Label(tab, text="Digite o texto para gerar hash:").pack(pady=10)
        
        self.hash_input = tk.Text(
            tab,
            height=5,
            width=60,
            wrap=tk.WORD,
            bg='#3e3e3e',
            fg='#ffffff',
            insertbackground='white'
        )
        self.hash_input.pack(pady=5)
        
        ttk.Label(tab, text="Selecione o algoritmo:").pack(pady=5)
        
        algo_frame = ttk.Frame(tab)
        algo_frame.pack(pady=5)
        
        self.hash_algo = tk.StringVar(value='sha256')
        
        algorithms = [
            ('MD5', 'md5'),
            ('SHA-1', 'sha1'),
            ('SHA-256', 'sha256'),
            ('SHA-512', 'sha512'),
            ('BLAKE2b', 'blake2b'),
            ('BLAKE2s', 'blake2s'),
            ('SHA-3 256', 'sha3_256'),
            ('SHA-3 512', 'sha3_512')
        ]
        
        for i, (name, algo) in enumerate(algorithms):
            rb = ttk.Radiobutton(
                algo_frame,
                text=name,
                variable=self.hash_algo,
                value=algo
            )
            rb.grid(row=i//4, column=i%4, padx=5, pady=2, sticky='w')
        
        ttk.Button(
            tab,
            text="Gerar Hash",
            command=self.generate_text_hash,
            style='Accent.TButton'
        ).pack(pady=15)
        
        ttk.Label(tab, text="Hash gerado:").pack(pady=5)
        
        self.hash_output = tk.Text(
            tab,
            height=5,
            width=60,
            wrap=tk.WORD,
            bg='#3e3e3e',
            fg='#ffffff',
            insertbackground='white'
        )
        self.hash_output.pack(pady=5)
        self.hash_output.config(state=tk.DISABLED)
        
        ttk.Button(
            tab,
            text="Copiar Hash",
            command=self.copy_text_hash
        ).pack(pady=5)
    
    def generate_text_hash(self):
        """Gera hash a partir do texto inserido"""
        text = self.hash_input.get("1.0", tk.END).strip()
        if not text:
            messagebox.showwarning("Aviso", "Por favor, digite um texto para gerar o hash.")
            return
        
        algo = self.hash_algo.get()
        
        try:
            if algo == 'md5':
                hash_obj = hashlib.md5(text.encode())
            elif algo == 'sha1':
                hash_obj = hashlib.sha1(text.encode())
            elif algo == 'sha256':
                hash_obj = hashlib.sha256(text.encode())
            elif algo == 'sha512':
                hash_obj = hashlib.sha512(text.encode())
            elif algo == 'blake2b':
                hash_obj = hashlib.blake2b(text.encode())
            elif algo == 'blake2s':
                hash_obj = hashlib.blake2s(text.encode())
            elif algo == 'sha3_256':
                hash_obj = hashlib.sha3_256(text.encode())
            elif algo == 'sha3_512':
                hash_obj = hashlib.sha3_512(text.encode())
            else:
                messagebox.showerror("Erro", "Algoritmo de hash inválido.")
                return
            
            hash_result = hash_obj.hexdigest()
            
            self.hash_output.config(state=tk.NORMAL)
            self.hash_output.delete(1.0, tk.END)
            self.hash_output.insert(tk.END, hash_result)
            self.hash_output.config(state=tk.DISABLED)
            
            self.update_status(f"Hash {algo.upper()} gerado com sucesso")
        
        except Exception as e:
            messagebox.showerror("Erro", f"Falha ao gerar hash: {str(e)}")
    
    def copy_text_hash(self):
        """Copia o hash gerado para a área de transferência"""
        hash_text = self.hash_output.get("1.0", tk.END).strip()
        if hash_text:
            self.root.clipboard_clear()
            self.root.clipboard_append(hash_text)
            self.update_status("Hash copiado para a área de transferência")
        else:
            messagebox.showwarning("Aviso", "Nenhum hash gerado para copiar.")
    
    def create_file_hash_tab(self, notebook):
        tab = ttk.Frame(notebook)
        notebook.add(tab, text="Hash de Arquivo")
        
        ttk.Label(tab, text="Selecione um arquivo para calcular seu hash:").pack(pady=10)
        
        ttk.Button(
            tab,
            text="Selecionar Arquivo",
            command=self.select_hash_file,
            style='Accent.TButton'
        ).pack(pady=5)
        
        self.hash_file_path = tk.StringVar()
        ttk.Label(
            tab,
            textvariable=self.hash_file_path,
            wraplength=500,
            foreground='#bdbdbd'
        ).pack(pady=5)
        
        ttk.Label(tab, text="Selecione o algoritmo:").pack(pady=5)
        
        self.file_hash_algo = tk.StringVar(value='sha256')
        
        algo_frame = ttk.Frame(tab)
        algo_frame.pack(pady=5)
        
        algorithms = [
            ('MD5', 'md5'),
            ('SHA-1', 'sha1'),
            ('SHA-256', 'sha256'),
            ('SHA-512', 'sha512'),
            ('BLAKE2b', 'blake2b'),
            ('BLAKE2s', 'blake2s')
        ]
        
        for i, (name, algo) in enumerate(algorithms):
            rb = ttk.Radiobutton(
                algo_frame,
                text=name,
                variable=self.file_hash_algo,
                value=algo
            )
            rb.grid(row=i//3, column=i%3, padx=5, pady=2, sticky='w')
        
        ttk.Button(
            tab,
            text="Calcular Hash",
            command=self.calculate_file_hash
        ).pack(pady=15)
        
        ttk.Label(tab, text="Hash do arquivo:").pack(pady=5)
        
        self.file_hash_output = tk.Text(
            tab,
            height=5,
            width=60,
            wrap=tk.WORD,
            bg='#3e3e3e',
            fg='#ffffff',
            insertbackground='white'
        )
        self.file_hash_output.pack(pady=5)
        self.file_hash_output.config(state=tk.DISABLED)
        
        ttk.Button(
            tab,
            text="Copiar Hash",
            command=self.copy_file_hash
        ).pack(pady=5)
    
    def select_hash_file(self):
        """Seleciona um arquivo para cálculo de hash"""
        filepath = filedialog.askopenfilename()
        if filepath:
            self.hash_file_path.set(filepath)
            self.update_status(f"Arquivo selecionado para hash: {filepath}")
    
    def calculate_file_hash(self):
        """Calcula o hash do arquivo selecionado"""
        filepath = self.hash_file_path.get()
        if not filepath:
            messagebox.showwarning("Aviso", "Por favor, selecione um arquivo.")
            return
        
        algo = self.file_hash_algo.get()
        
        try:
            hash_obj = None
            
            if algo == 'md5':
                hash_obj = hashlib.md5()
            elif algo == 'sha1':
                hash_obj = hashlib.sha1()
            elif algo == 'sha256':
                hash_obj = hashlib.sha256()
            elif algo == 'sha512':
                hash_obj = hashlib.sha512()
            elif algo == 'blake2b':
                hash_obj = hashlib.blake2b()
            elif algo == 'blake2s':
                hash_obj = hashlib.blake2s()
            else:
                messagebox.showerror("Erro", "Algoritmo de hash inválido.")
                return
            
            # Lê o arquivo em chunks para evitar problemas com arquivos grandes
            with open(filepath, 'rb') as f:
                while chunk := f.read(8192):
                    hash_obj.update(chunk)
            
            hash_result = hash_obj.hexdigest()
            
            self.file_hash_output.config(state=tk.NORMAL)
            self.file_hash_output.delete(1.0, tk.END)
            self.file_hash_output.insert(tk.END, hash_result)
            self.file_hash_output.config(state=tk.DISABLED)
            
            self.update_status(f"Hash {algo.upper()} calculado para o arquivo")
        
        except Exception as e:
            messagebox.showerror("Erro", f"Falha ao calcular hash: {str(e)}")
    
    def copy_file_hash(self):
        """Copia o hash do arquivo para a área de transferência"""
        hash_text = self.file_hash_output.get("1.0", tk.END).strip()
        if hash_text:
            self.root.clipboard_clear()
            self.root.clipboard_append(hash_text)
            self.update_status("Hash do arquivo copiado para a área de transferência")
        else:
            messagebox.showwarning("Aviso", "Nenhum hash calculado para copiar.")

if __name__ == "__main__":
    root = tk.Tk()
    
    # Configurar estilo adicional
    style = ttk.Style()
    style.configure('Accent.TButton', foreground='white', background='#0078d7')
    style.map('Accent.TButton', background=[('active', '#006cbd')])
    
    app = AdvancedCyberSecurityTool(root)
    root.mainloop()

    #INSTALE:
    # pip install pillow exifread cryptography
    