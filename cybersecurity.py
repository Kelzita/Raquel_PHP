import tkinter as tk
from tkinter import ttk, messagebox, filedialog, scrolledtext
import hashlib
import socket
import threading
import os
import requests
import json
import subprocess
import random
import string
import time
import datetime
from cryptography.fernet import Fernet
from cryptography.hazmat.primitives import serialization
from cryptography.hazmat.primitives.asymmetric import rsa
import exifread
import whois
import dns.resolver
from PIL import Image, ImageTk
import pdfkit
import nmap
from scapy.all import sniff, IP, TCP, UDP, ARP
import matplotlib.pyplot as plt
from matplotlib.backends.backend_tkagg import FigureCanvasTkAgg
import pandas as pd
import numpy as np

# Configuração de estilo
DARK_BG = "#1e1e1e"
DARK_FG = "#e0e0e0"
ACCENT_COLOR = "#007acc"
HIGHLIGHT_COLOR = "#4fc3f7"
WARNING_COLOR = "#ff9800"
ERROR_COLOR = "#f44336"
SUCCESS_COLOR = "#4caf50"

class CyberSecurityPro:
    def __init__(self, root):
        self.root = root
        self.root.title("Cyber Security Toolkit Pro - Ultimate Edition")
        self.root.geometry("1200x800")
        self.root.minsize(1100, 700)
        
        # Configuração do tema
        self.setup_style()
        
        # Variáveis de estado
        self.current_project = None
        self.scan_active = False
        self.sniffer_active = False
        self.report_data = []
        
        # Layout principal
        self.create_main_layout()
        
        # Carrega APIs (configuração simplificada)
        self.load_api_config()
        
        # Inicializa módulos
        self.init_modules()
        
        # Barra de status
        self.setup_status_bar()
        
        # Atualiza a interface
        self.update_ui()

    def setup_style(self):
        """Configura o tema visual da aplicação"""
        self.root.tk_setPalette(
            background=DARK_BG,
            foreground=DARK_FG,
            activeBackground="#333333",
            activeForeground="#ffffff"
        )
        
        style = ttk.Style()
        style.theme_use('clam')
        
        # Configurações gerais
        style.configure('.', background=DARK_BG, foreground=DARK_FG)
        style.configure('TFrame', background=DARK_BG)
        style.configure('TLabel', background=DARK_BG, foreground=DARK_FG)
        style.configure('TEntry', fieldbackground="#252525", foreground=DARK_FG)
        style.configure('TCombobox', fieldbackground="#252525", foreground=DARK_FG)
        style.configure('TButton', background="#333333", foreground=DARK_FG)
        style.map('TButton', background=[('active', '#444444')])
        
        # Estilo personalizado para botões de ação
        style.configure('Accent.TButton', background=ACCENT_COLOR, foreground="white")
        style.map('Accent.TButton', background=[('active', '#0066b3')])
        
        # Estilo para Treeview
        style.configure('Treeview', 
                      background="#252525", 
                      fieldbackground="#252525", 
                      foreground=DARK_FG)
        style.map('Treeview', background=[('selected', ACCENT_COLOR)])
        
        # Estilo para abas
        style.configure('TNotebook', background=DARK_BG, borderwidth=0)
        style.configure('TNotebook.Tab', 
                      background="#2d2d2d", 
                      foreground=DARK_FG,
                      padding=[10, 5])
        style.map('TNotebook.Tab', 
                background=[('selected', DARK_BG)],
                foreground=[('selected', HIGHLIGHT_COLOR)])

    def create_main_layout(self):
        """Cria o layout principal da aplicação"""
        # Cabeçalho
        self.create_header()
        
        # Painel principal
        main_panel = ttk.Frame(self.root)
        main_panel.pack(fill=tk.BOTH, expand=True, padx=10, pady=(0, 5))
        
        # Painel de navegação
        nav_panel = ttk.Frame(main_panel, width=200)
        nav_panel.pack(side=tk.LEFT, fill=tk.Y)
        nav_panel.pack_propagate(False)
        
        # Notebook principal
        self.main_notebook = ttk.Notebook(main_panel)
        self.main_notebook.pack(side=tk.LEFT, fill=tk.BOTH, expand=True)
        
        # Cria os módulos
        self.create_navigation(nav_panel)
        self.create_dashboard_tab()
        self.create_password_tools()
        self.create_network_tools()
        self.create_crypto_tools()
        self.create_vulnerability_tools()
        self.create_malware_tools()
        self.create_forensic_tools()
        self.create_reporting_tools()
        self.create_project_tools()
        self.create_settings_tab()

    def create_header(self):
        """Cria o cabeçalho da aplicação"""
        header = ttk.Frame(self.root, height=80)
        header.pack(fill=tk.X, padx=10, pady=10)
        
        # Logo
        logo_frame = ttk.Frame(header)
        logo_frame.pack(side=tk.LEFT)
        
        # Ícone (simulado com texto)
        ttk.Label(logo_frame, text="🛡️", font=('Arial', 24)).pack(side=tk.LEFT)
        
        # Título
        ttk.Label(logo_frame, 
                text="Cyber Security Pro", 
                font=('Arial', 16, 'bold'),
                foreground=HIGHLIGHT_COLOR).pack(side=tk.LEFT, padx=10)
        
        # Barra de estado do projeto
        self.project_status = ttk.Label(header, 
                                      text="Nenhum projeto aberto", 
                                      foreground="#b0b0b0")
        self.project_status.pack(side=tk.RIGHT)

    def setup_status_bar(self):
        """Configura a barra de status"""
        self.status_var = tk.StringVar()
        status_bar = ttk.Label(self.root, 
                             textvariable=self.status_var, 
                             relief=tk.SUNKEN, 
                             anchor=tk.W)
        status_bar.pack(side=tk.BOTTOM, fill=tk.X)
        
        self.update_status("Pronto")

    def update_status(self, message):
        """Atualiza a barra de status"""
        timestamp = datetime.datetime.now().strftime("%H:%M:%S")
        self.status_var.set(f"[{timestamp}] {message}")

    def create_navigation(self, parent):
        """Cria a barra de navegação lateral"""
        # Botões de navegação
        nav_buttons = [
            ("Dashboard", self.show_dashboard),
            ("Ferramentas de Senha", self.show_password_tools),
            ("Ferramentas de Rede", self.show_network_tools),
            ("Criptografia", self.show_crypto_tools),
            ("Vulnerabilidades", self.show_vulnerability_tools),
            ("Análise de Malware", self.show_malware_tools),
            ("Forense Digital", self.show_forensic_tools),
            ("Relatórios", self.show_reporting_tools),
            ("Gerenciar Projeto", self.show_project_tools),
            ("Configurações", self.show_settings)
        ]
        
        for text, command in nav_buttons:
            btn = ttk.Button(parent, 
                           text=text, 
                           command=command,
                           style='Accent.TButton' if text == "Dashboard" else 'TButton')
            btn.pack(fill=tk.X, pady=2)

    def create_dashboard_tab(self):
        """Cria a aba de dashboard"""
        self.dashboard_tab = ttk.Frame(self.main_notebook)
        self.main_notebook.add(self.dashboard_tab, text="Dashboard")
        
        # Linha superior (métricas)
        metrics_frame = ttk.Frame(self.dashboard_tab)
        metrics_frame.pack(fill=tk.X, pady=10)
        
        # Métricas (simuladas)
        metrics = [
            ("Projetos Ativos", "3", SUCCESS_COLOR),
            ("Vulnerabilidades", "12", WARNING_COLOR),
            ("Scans Hoje", "5", ACCENT_COLOR),
            ("Ameaças Detectadas", "2", ERROR_COLOR)
        ]
        
        for i, (title, value, color) in enumerate(metrics):
            metric_frame = ttk.Frame(metrics_frame, relief=tk.RAISED, borderwidth=1)
            metric_frame.grid(row=0, column=i, padx=5, sticky="nsew")
            
            ttk.Label(metric_frame, 
                    text=title, 
                    font=('Arial', 10)).pack(pady=(5, 0))
            ttk.Label(metric_frame, 
                    text=value, 
                    font=('Arial', 24, 'bold'),
                    foreground=color).pack()
            
            metrics_frame.columnconfigure(i, weight=1)
        
        # Gráfico de atividades (simulado)
        chart_frame = ttk.Frame(self.dashboard_tab)
        chart_frame.pack(fill=tk.BOTH, expand=True, pady=10)
        
        fig, ax = plt.subplots(figsize=(8, 4), facecolor=DARK_BG)
        ax.set_facecolor(DARK_BG)
        
        # Dados simulados
        days = ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom']
        scans = [5, 7, 3, 8, 12, 4, 6]
        threats = [1, 0, 2, 3, 1, 0, 2]
        
        ax.plot(days, scans, label='Scans', color=ACCENT_COLOR, marker='o')
        ax.plot(days, threats, label='Ameaças', color=ERROR_COLOR, marker='o')
        
        ax.set_title('Atividades da Semana', color=DARK_FG)
        ax.set_xlabel('Dia', color=DARK_FG)
        ax.set_ylabel('Quantidade', color=DARK_FG)
        ax.legend(facecolor=DARK_BG, labelcolor=DARK_FG)
        ax.tick_params(colors=DARK_FG)
        
        for spine in ax.spines.values():
            spine.set_edgecolor(DARK_FG)
        
        chart = FigureCanvasTkAgg(fig, master=chart_frame)
        chart.draw()
        chart.get_tk_widget().pack(fill=tk.BOTH, expand=True)
        
        # Últimas atividades
        activities_frame = ttk.LabelFrame(self.dashboard_tab, text="Últimas Atividades", padding=10)
        activities_frame.pack(fill=tk.BOTH, pady=10)
        
        columns = ("Data", "Tipo", "Descrição", "Status")
        self.activities_table = ttk.Treeview(activities_frame, columns=columns, show="headings", height=5)
        
        for col in columns:
            self.activities_table.heading(col, text=col)
            self.activities_table.column(col, width=100)
        
        self.activities_table.pack(fill=tk.BOTH, expand=True)
        
        # Dados simulados
        activities = [
            ("10/05 14:30", "Scan", "Port scan em 192.168.1.1", "Concluído"),
            ("10/05 12:15", "Análise", "Verificação de malware", "Falha"),
            ("09/05 18:40", "Pentest", "Teste de SQL injection", "Em andamento")
        ]
        
        for act in activities:
            self.activities_table.insert('', tk.END, values=act)

    def create_password_tools(self):
        """Cria a aba de ferramentas de senha"""
        self.password_tab = ttk.Frame(self.main_notebook)
        self.main_notebook.add(self.password_tab, text="Senhas")
        
        notebook = ttk.Notebook(self.password_tab)
        notebook.pack(fill=tk.BOTH, expand=True)
        
        # Sub-aba: Verificador de senha
        self.create_password_checker_tab(notebook)
        
        # Sub-aba: Gerador de senha
        self.create_password_generator_tab(notebook)
        
        # Sub-aba: Wordlist generator
        self.create_wordlist_generator_tab(notebook)
        
        # Sub-aba: Password spraying
        self.create_password_spraying_tab(notebook)

    def create_password_checker_tab(self, notebook):
        """Cria a sub-aba de verificação de senha"""
        tab = ttk.Frame(notebook)
        notebook.add(tab, text="Verificador")
        
        ttk.Label(tab, text="Digite uma senha para verificar:").pack(pady=10)
        
        self.password_entry = ttk.Entry(tab, show="•", width=40)
        self.password_entry.pack(pady=5)
        
        check_btn = ttk.Button(tab, 
                             text="Verificar Senha", 
                             command=self.check_password_strength,
                             style='Accent.TButton')
        check_btn.pack(pady=10)
        
        # Medidor de força
        self.strength_meter = ttk.Progressbar(tab, 
                                            orient=tk.HORIZONTAL, 
                                            length=300, 
                                            mode='determinate')
        self.strength_meter.pack(pady=5)
        
        self.strength_label = ttk.Label(tab, 
                                      text="", 
                                      font=('Arial', 12))
        self.strength_label.pack(pady=5)
        
        # Sugestões
        self.suggestions_text = scrolledtext.ScrolledText(
            tab, 
            height=8, 
            width=60, 
            wrap=tk.WORD, 
            bg="#252525", 
            fg=DARK_FG,
            insertbackground='white'
        )
        self.suggestions_text.pack(pady=5)
        self.suggestions_text.insert(tk.END, "Sugestões aparecerão aqui...")
        self.suggestions_text.config(state=tk.DISABLED)

    def check_password_strength(self):
        """Verifica a força da senha"""
        password = self.password_entry.get()
        if not password:
            messagebox.showwarning("Aviso", "Digite uma senha para verificar.")
            return
        
        # Verifica se a senha foi vazada
        is_breached = self.check_hibp(password)
        
        # Calcula a força
        strength = 0
        suggestions = []
        
        # Comprimento
        if len(password) >= 16:
            strength += 3
        elif len(password) >= 12:
            strength += 2
        elif len(password) >= 8:
            strength += 1
        else:
            suggestions.append("🔸 Use pelo menos 12 caracteres (16+ recomendado)")
        
        # Complexidade
        has_upper = any(c.isupper() for c in password)
        has_lower = any(c.islower() for c in password)
        has_digit = any(c.isdigit() for c in password)
        has_special = any(c in string.punctuation for c in password)
        
        if has_upper and has_lower:
            strength += 1
        else:
            suggestions.append("🔸 Use letras maiúsculas e minúsculas")
        
        if has_digit:
            strength += 1
        else:
            suggestions.append("🔸 Adicione números")
        
        if has_special:
            strength += 1
        else:
            suggestions.append("🔸 Adicione caracteres especiais (!@#$%^&*)")
        
        # Verifica senhas comuns
        common_passwords = ["password", "123456", "qwerty", "admin", "welcome"]
        if password.lower() in common_passwords:
            strength = 0
            suggestions.append("🚨 SENHA MUITO COMUM - NÃO USE!")
        
        # Verifica se foi vazada
        if is_breached:
            strength = 0
            suggestions.append("🚨 ESTA SENHA FOI VAZADA EM BREACHES - NÃO USE!")
        
        # Atualiza a interface
        strength_score = min(100, (strength / 7) * 100)
        self.strength_meter['value'] = strength_score
        
        if strength_score >= 80:
            self.strength_label.config(text="Senha Excelente", foreground=SUCCESS_COLOR)
        elif strength_score >= 60:
            self.strength_label.config(text="Senha Boa", foreground="#8BC34A")
        elif strength_score >= 40:
            self.strength_label.config(text="Senha Razoável", foreground=WARNING_COLOR)
        elif strength_score >= 20:
            self.strength_label.config(text="Senha Fraca", foreground="#FF5722")
        else:
            self.strength_label.config(text="Senha Muito Fraca", foreground=ERROR_COLOR)
        
        # Mostra sugestões
        self.suggestions_text.config(state=tk.NORMAL)
        self.suggestions_text.delete(1.0, tk.END)
        
        if not suggestions:
            self.suggestions_text.insert(tk.END, "✅ Sua senha atende aos critérios de segurança!")
        else:
            self.suggestions_text.insert(tk.END, "\n".join(suggestions))
        
        self.suggestions_text.config(state=tk.DISABLED)
        self.update_status("Verificação de senha concluída")

    def check_hibp(self, password):
        """Verifica se a senha foi vazada usando a API do Have I Been Pwned"""
        try:
            # Hash SHA-1 da senha
            sha1_hash = hashlib.sha1(password.encode()).hexdigest().upper()
            prefix = sha1_hash[:5]
            suffix = sha1_hash[5:]
            
            # Faz a requisição para a API
            url = f"https://api.pwnedpasswords.com/range/{prefix}"
            response = requests.get(url)
            
            if response.status_code == 200:
                # Verifica se o hash está na lista
                hashes = [line.split(':') for line in response.text.splitlines()]
                for h, count in hashes:
                    if h == suffix:
                        return True
            return False
        except:
            return False

    def create_password_generator_tab(self, notebook):
        """Cria a sub-aba de geração de senha"""
        tab = ttk.Frame(notebook)
        notebook.add(tab, text="Gerador")
        
        ttk.Label(tab, text="Tamanho da senha:").pack(pady=5)
        
        self.pwd_length = tk.IntVar(value=16)
        ttk.Scale(tab, from_=8, to=32, variable=self.pwd_length, orient=tk.HORIZONTAL).pack(fill=tk.X, pady=5)
        
        ttk.Label(tab, text="Caracteres a incluir:").pack(pady=5)
        
        self.include_upper = tk.BooleanVar(value=True)
        ttk.Checkbutton(tab, text="Letras maiúsculas (A-Z)", variable=self.include_upper).pack(anchor='w')
        
        self.include_lower = tk.BooleanVar(value=True)
        ttk.Checkbutton(tab, text="Letras minúsculas (a-z)", variable=self.include_lower).pack(anchor='w')
        
        self.include_digits = tk.BooleanVar(value=True)
        ttk.Checkbutton(tab, text="Números (0-9)", variable=self.include_digits).pack(anchor='w')
        
        self.include_special = tk.BooleanVar(value=True)
        ttk.Checkbutton(tab, text="Caracteres especiais (!@#$)", variable=self.include_special).pack(anchor='w')
        
        ttk.Button(tab, 
                  text="Gerar Senha", 
                  command=self.generate_password,
                  style='Accent.TButton').pack(pady=15)
        
        self.generated_password = ttk.Entry(tab, width=40, font=('Arial', 12), justify='center')
        self.generated_password.pack(pady=5)
        
        btn_frame = ttk.Frame(tab)
        btn_frame.pack(pady=5)
        
        ttk.Button(btn_frame, text="Copiar", command=self.copy_password).pack(side=tk.LEFT, padx=5)
        ttk.Button(btn_frame, text="Verificar", command=self.check_generated_password).pack(side=tk.LEFT, padx=5)

    def generate_password(self):
        """Gera uma senha aleatória"""
        length = self.pwd_length.get()
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
        
        # Garante que pelo menos um de cada tipo selecionado seja incluído
        password = []
        if self.include_upper.get():
            password.append(random.choice(string.ascii_uppercase))
        if self.include_lower.get():
            password.append(random.choice(string.ascii_lowercase))
        if self.include_digits.get():
            password.append(random.choice(string.digits))
        if self.include_special.get():
            password.append(random.choice(string.punctuation))
        
        # Preenche o resto
        remaining = length - len(password)
        password.extend(random.choice(chars) for _ in range(remaining))
        
        # Embaralha
        random.shuffle(password)
        password = ''.join(password)
        
        self.generated_password.delete(0, tk.END)
        self.generated_password.insert(0, password)
        self.update_status("Senha gerada com sucesso")

    def copy_password(self):
        """Copia a senha gerada para a área de transferência"""
        password = self.generated_password.get()
        if password:
            self.root.clipboard_clear()
            self.root.clipboard_append(password)
            self.update_status("Senha copiada para a área de transferência")
        else:
            messagebox.showwarning("Aviso", "Nenhuma senha gerada para copiar.")

    def check_generated_password(self):
        """Verifica a força da senha gerada"""
        password = self.generated_password.get()
        if password:
            self.password_entry.delete(0, tk.END)
            self.password_entry.insert(0, password)
            self.check_password_strength()
        else:
            messagebox.showwarning("Aviso", "Nenhuma senha gerada para verificar.")

    def create_wordlist_generator_tab(self, notebook):
        """Cria a sub-aba de geração de wordlists"""
        tab = ttk.Frame(notebook)
        notebook.add(tab, text="Wordlist")
        
        ttk.Label(tab, text="Palavras base (separadas por vírgula):").pack(pady=5)
        
        self.wordlist_base = scrolledtext.ScrolledText(tab, height=5, width=50, wrap=tk.WORD)
        self.wordlist_base.pack(pady=5)
        
        ttk.Label(tab, text="Anos a adicionar:").pack(pady=5)
        self.wordlist_years = ttk.Entry(tab)
        self.wordlist_years.pack(fill=tk.X, pady=5)
        self.wordlist_years.insert(0, "2020,2021,2022,2023,2024")
        
        ttk.Label(tab, text="Números a adicionar:").pack(pady=5)
        self.wordlist_numbers = ttk.Entry(tab)
        self.wordlist_numbers.pack(fill=tk.X, pady=5)
        self.wordlist_numbers.insert(0, "1,2,12,123,1234,12345")
        
        ttk.Label(tab, text="Caracteres especiais:").pack(pady=5)
        self.wordlist_specials = ttk.Entry(tab)
        self.wordlist_specials.pack(fill=tk.X, pady=5)
        self.wordlist_specials.insert(0, "!,@,#,$,%,&,*")
        
        ttk.Button(tab, 
                  text="Gerar Wordlist", 
                  command=self.generate_wordlist,
                  style='Accent.TButton').pack(pady=15)
        
        ttk.Label(tab, text="Wordlist gerada:").pack(pady=5)
        
        self.wordlist_output = scrolledtext.ScrolledText(tab, height=10, width=60, wrap=tk.WORD)
        self.wordlist_output.pack(pady=5)
        
        btn_frame = ttk.Frame(tab)
        btn_frame.pack(pady=5)
        
        ttk.Button(btn_frame, text="Copiar", command=self.copy_wordlist).pack(side=tk.LEFT, padx=5)
        ttk.Button(btn_frame, text="Salvar", command=self.save_wordlist).pack(side=tk.LEFT, padx=5)

    def generate_wordlist(self):
        """Gera uma wordlist personalizada"""
        base_text = self.wordlist_base.get("1.0", tk.END).strip()
        if not base_text:
            messagebox.showwarning("Aviso", "Digite pelo menos uma palavra base.")
            return
        
        bases = [b.strip() for b in base_text.split(',') if b.strip()]
        years = [y.strip() for y in self.wordlist_years.get().split(',') if y.strip()]
        numbers = [n.strip() for n in self.wordlist_numbers.get().split(',') if n.strip()]
        specials = [s.strip() for s in self.wordlist_specials.get().split(',') if s.strip()]
        
        wordlist = set()
        
        # Gera todas as combinações
        for base in bases:
            wordlist.add(base)
            
            # Adiciona anos
            for year in years:
                wordlist.add(base + year)
                wordlist.add(year + base)
            
            # Adiciona números
            for number in numbers:
                wordlist.add(base + number)
                wordlist.add(number + base)
            
            # Adiciona caracteres especiais
            for special in specials:
                wordlist.add(base + special)
                wordlist.add(special + base)
                
                # Combina com números também
                for number in numbers:
                    wordlist.add(base + special + number)
                    wordlist.add(base + number + special)
                    wordlist.add(special + base + number)
        
        # Ordena a wordlist
        sorted_wordlist = sorted(wordlist, key=lambda x: (len(x), x))
        
        # Mostra na caixa de texto
        self.wordlist_output.delete(1.0, tk.END)
        self.wordlist_output.insert(tk.END, "\n".join(sorted_wordlist))
        
        self.update_status(f"Wordlist gerada com {len(sorted_wordlist)} entradas")

    def copy_wordlist(self):
        """Copia a wordlist para a área de transferência"""
        wordlist = self.wordlist_output.get("1.0", tk.END).strip()
        if wordlist:
            self.root.clipboard_clear()
            self.root.clipboard_append(wordlist)
            self.update_status("Wordlist copiada para a área de transferência")
        else:
            messagebox.showwarning("Aviso", "Nenhuma wordlist gerada para copiar.")

    def save_wordlist(self):
        """Salva a wordlist em um arquivo"""
        wordlist = self.wordlist_output.get("1.0", tk.END).strip()
        if not wordlist:
            messagebox.showwarning("Aviso", "Nenhuma wordlist gerada para salvar.")
            return
        
        filepath = filedialog.asksaveasfilename(
            defaultextension=".txt",
            filetypes=[("Arquivos de texto", "*.txt"), ("Todos os arquivos", "*.*")]
        )
        
        if filepath:
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(wordlist)
            
            self.update_status(f"Wordlist salva em: {filepath}")
            messagebox.showinfo("Sucesso", "Wordlist salva com sucesso!")

    def create_password_spraying_tab(self, notebook):
        """Cria a sub-aba de password spraying"""
        tab = ttk.Frame(notebook)
        notebook.add(tab, text="Password Spraying")
        
        ttk.Label(tab, text="ALERTA: Esta ferramenta deve ser usada apenas para testes autorizados!", foreground=ERROR_COLOR).pack(pady=10)
        
        ttk.Label(tab, text="Alvo (URL ou IP):").pack(pady=5)
        self.spray_target = ttk.Entry(tab)
        self.spray_target.pack(fill=tk.X, pady=5)
        
        ttk.Label(tab, text="Usuários (um por linha):").pack(pady=5)
        self.spray_users = scrolledtext.ScrolledText(tab, height=5, wrap=tk.WORD)
        self.spray_users.pack(fill=tk.X, pady=5)
        
        ttk.Label(tab, text="Senhas para testar (uma por linha):").pack(pady=5)
        self.spray_passwords = scrolledtext.ScrolledText(tab, height=5, wrap=tk.WORD)
        self.spray_passwords.pack(fill=tk.X, pady=5)
        
        ttk.Label(tab, text="Tempo entre tentativas (segundos):").pack(pady=5)
        self.spray_delay = ttk.Spinbox(tab, from_=1, to=60, width=5)
        self.spray_delay.pack(pady=5)
        self.spray_delay.set("5")
        
        ttk.Button(tab, 
                  text="Iniciar Teste", 
                  command=self.run_password_spraying,
                  style='Accent.TButton').pack(pady=15)
        
        ttk.Label(tab, text="Resultados:").pack(pady=5)
        self.spray_results = scrolledtext.ScrolledText(tab, height=10, wrap=tk.WORD)
        self.spray_results.pack(fill=tk.BOTH, expand=True, pady=5)
        self.spray_results.config(state=tk.DISABLED)

    def run_password_spraying(self):
        """Executa o teste de password spraying (simulado)"""
        target = self.spray_target.get()
        users = self.spray_users.get("1.0", tk.END).strip().splitlines()
        passwords = self.spray_passwords.get("1.0", tk.END).strip().splitlines()
        delay = int(self.spray_delay.get())
        
        if not target or not users or not passwords:
            messagebox.showwarning("Aviso", "Preencha todos os campos.")
            return
        
        self.spray_results.config(state=tk.NORMAL)
        self.spray_results.delete(1.0, tk.END)
        self.spray_results.insert(tk.END, f"Iniciando password spraying em {target}...\n\n")
        self.spray_results.see(tk.END)
        self.update_status(f"Iniciando password spraying em {target}")
        
        # Simulação (em uma aplicação real, isso faria requisições HTTP)
        for user in users:
            if not user.strip():
                continue
                
            for pwd in passwords:
                if not pwd.strip():
                    continue
                    
                # Simula uma tentativa de login
                self.spray_results.insert(tk.END, f"Testando {user}:{pwd}... ")
                
                # Simula um resultado aleatório
                if random.random() < 0.1:  # 10% de chance de "sucesso"
                    self.spray_results.insert(tk.END, "SUCESSO (credencial válida)\n", "success")
                else:
                    self.spray_results.insert(tk.END, "falha\n")
                
                self.spray_results.see(tk.END)
                self.root.update()
                
                # Delay entre tentativas
                time.sleep(delay)
        
        self.spray_results.insert(tk.END, "\nTeste concluído.\n")
        self.spray_results.config(state=tk.DISABLED)
        self.update_status("Password spraying concluído")

    # [Continuação com os outros módulos...]
    # Implementação similar para as outras abas:
    # - create_network_tools()
    # - create_crypto_tools()
    # - create_vulnerability_tools()
    # - create_malware_tools()
    # - create_forensic_tools()
    # - create_reporting_tools()
    # - create_project_tools()
    # - create_settings_tab()

    def show_dashboard(self):
        """Mostra a aba de dashboard"""
        self.main_notebook.select(self.dashboard_tab)

    def show_password_tools(self):
        """Mostra a aba de ferramentas de senha"""
        self.main_notebook.select(self.password_tab)

    # [Métodos similares para as outras funções de navegação...]

    def load_api_config(self):
        """Carrega as configurações de API (simulado)"""
        self.api_config = {
            "virustotal": {"key": "", "enabled": False},
            "hibp": {"key": "", "enabled": True},
            "nvd": {"key": "", "enabled": False}
        }

    def init_modules(self):
        """Inicializa os módulos da aplicação"""
        self.nm = nmap.PortScanner() if self.api_config.get("nmap", {}).get("enabled", False) else None

    def update_ui(self):
        """Atualiza a interface do usuário"""
        # Atualiza o status do projeto
        if self.current_project:
            self.project_status.config(text=f"Projeto: {self.current_project}", foreground=SUCCESS_COLOR)
        else:
            self.project_status.config(text="Nenhum projeto aberto", foreground=WARNING_COLOR)

# Função principal
if __name__ == "__main__":
    root = tk.Tk()
    
    # Configura o ícone (se disponível)
    try:
        root.iconbitmap("shield.ico")  # Substitua pelo caminho do seu ícone
    except:
        pass
    
    app = CyberSecurityPro(root)
    root.mainloop()