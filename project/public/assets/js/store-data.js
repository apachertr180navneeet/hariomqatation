/**
 * Hari Om Computer - Local Data Engine & Storage Sync
 * Provides realistic dummy datasets, Indian Rupee formatting, and localStorage persistence.
 */

const HOC_DATA = {
  storeInfo: {
    name: "Hari Om Computer",
    tagline: "Your Trusted Computer & Technology Partner",
    address: "Plot No. 42, Near Sojati Gate, Station Road, Jodhpur, Rajasthan - 342001",
    phone: "+91 98290 12345 / 0291-2654321",
    email: "info@hariomcomputer.com",
    salesEmail: "sales@hariomcomputer.com",
    gstin: "08AABCH1234F1Z9",
    pan: "AABCH1234F",
    bank: {
      accountName: "HARI OM COMPUTER",
      bankName: "HDFC Bank Ltd",
      accountNo: "50200087654321",
      ifsc: "HDFC0001234",
      branch: "Sojati Gate, Jodhpur"
    },
    openingHours: "Mon - Sat: 10:00 AM - 8:30 PM (Sunday Closed)",
    terms: [
      "Quotation is valid for 15 days from the date of issue.",
      "Prices are inclusive of 18% GST unless explicitly specified otherwise.",
      "100% payment on delivery or against delivery for ready stock.",
      "Manufacturer standard warranty applies on all genuine hardware components.",
      "Goods once sold will not be returned or exchanged under normal conditions."
    ]
  },

  brands: [
    { id: "b-dell", name: "Dell", logo: "dell.svg", count: 14, status: "Active" },
    { id: "b-hp", name: "HP", logo: "hp.svg", count: 12, status: "Active" },
    { id: "b-lenovo", name: "Lenovo", logo: "lenovo.svg", count: 10, status: "Active" },
    { id: "b-asus", name: "ASUS", logo: "asus.svg", count: 18, status: "Active" },
    { id: "b-acer", name: "Acer", logo: "acer.svg", count: 8, status: "Active" },
    { id: "b-msi", name: "MSI", logo: "msi.svg", count: 9, status: "Active" },
    { id: "b-intel", name: "Intel", logo: "intel.svg", count: 16, status: "Active" },
    { id: "b-amd", name: "AMD", logo: "amd.svg", count: 15, status: "Active" },
    { id: "b-nvidia", name: "NVIDIA", logo: "nvidia.svg", count: 11, status: "Active" },
    { id: "b-gigabyte", name: "Gigabyte", logo: "gigabyte.svg", count: 10, status: "Active" },
    { id: "b-corsair", name: "Corsair", logo: "corsair.svg", count: 14, status: "Active" },
    { id: "b-kingston", name: "Kingston", logo: "kingston.svg", count: 12, status: "Active" },
    { id: "b-samsung", name: "Samsung", logo: "samsung.svg", count: 15, status: "Active" },
    { id: "b-wd", name: "Western Digital", logo: "wd.svg", count: 9, status: "Active" },
    { id: "b-seagate", name: "Seagate", logo: "seagate.svg", count: 7, status: "Active" },
    { id: "b-logitech", name: "Logitech", logo: "logitech.svg", count: 18, status: "Active" },
    { id: "b-tplink", name: "TP-Link", logo: "tplink.svg", count: 11, status: "Active" }
  ],

  categories: [
    {
      id: "cat-laptops",
      name: "Laptops",
      icon: "bi-laptop",
      subcategories: ["Business Laptop", "Student Laptop", "Gaming Laptop", "Professional Laptop", "Ultrabook"]
    },
    {
      id: "cat-computers",
      name: "Desktop Computers",
      icon: "bi-pc-display",
      subcategories: ["Office PC", "Home PC", "Gaming PC", "Editing Workstation", "All-in-One PC"]
    },
    {
      id: "cat-components",
      name: "Components",
      icon: "bi-cpu",
      subcategories: ["Processor", "Motherboard", "RAM", "SSD", "HDD", "Graphics Card", "SMPS/PSU", "Cabinet", "CPU Cooler"]
    },
    {
      id: "cat-display",
      name: "Display & Monitors",
      icon: "bi-display",
      subcategories: ["LED Monitor", "Gaming Monitor", "4K Professional Monitor", "Projector"]
    },
    {
      id: "cat-accessories",
      name: "Accessories",
      icon: "bi-keyboard",
      subcategories: ["Keyboard & Mouse", "Headphones", "Webcam", "Speakers", "UPS", "Printers", "Pendrive"]
    },
    {
      id: "cat-networking",
      name: "Networking",
      icon: "bi-router",
      subcategories: ["WiFi Router", "Network Switch", "LAN Cable", "WiFi Adapter"]
    }
  ],

  products: [
    // Laptops
    {
      id: "PROD-1001",
      name: "Dell Inspiron 15 3520 Laptop",
      sku: "DELL-INSP-3520",
      category: "Laptops",
      subcategory: "Student Laptop",
      brand: "Dell",
      model: "Inspiron 15 3520",
      specs: "Intel Core i5 12th Gen | 16GB DDR4 RAM | 512GB NVMe SSD | 15.6\" FHD 120Hz | Windows 11 + MS Office",
      purchasePrice: 42000,
      sellingPrice: 47990,
      mrp: 58990,
      gstRate: 18,
      stock: 14,
      minStock: 4,
      warranty: "1 Year Onsite Warranty",
      status: "Active",
      rating: 4.6,
      image: "laptop-dell.jpg",
      isFeatured: true
    },
    {
      id: "PROD-1002",
      name: "HP Pavilion 15 (2025 Edition)",
      sku: "HP-PAV-15-EG",
      category: "Laptops",
      subcategory: "Business Laptop",
      brand: "HP",
      model: "Pavilion 15-eg3027TU",
      specs: "Intel Core i7 13th Gen 1355U | 16GB DDR4 | 1TB NVMe SSD | Intel Iris Xe | 15.6\" FHD IPS | Backlit KB",
      purchasePrice: 61000,
      sellingPrice: 68490,
      mrp: 79990,
      gstRate: 18,
      stock: 9,
      minStock: 3,
      warranty: "1 Year Onsite Warranty",
      status: "Active",
      rating: 4.7,
      image: "laptop-hp.jpg",
      isFeatured: true
    },
    {
      id: "PROD-1003",
      name: "Lenovo IdeaPad Slim 3 Gen 8",
      sku: "LEN-SLIM3-AMD",
      category: "Laptops",
      subcategory: "Student Laptop",
      brand: "Lenovo",
      model: "IdeaPad Slim 3 15ABR8",
      specs: "AMD Ryzen 5 7530U (6C/12T) | 16GB LPDDR5 | 512GB Gen4 SSD | 15.6\" Anti-glare FHD | Win 11",
      purchasePrice: 38500,
      sellingPrice: 43990,
      mrp: 52990,
      gstRate: 18,
      stock: 12,
      minStock: 4,
      warranty: "2 Years Onsite Warranty",
      status: "Active",
      rating: 4.5,
      image: "laptop-lenovo.jpg",
      isFeatured: false
    },
    {
      id: "PROD-1004",
      name: "ASUS TUF Gaming F15",
      sku: "ASUS-TUF-F15",
      category: "Laptops",
      subcategory: "Gaming Laptop",
      brand: "ASUS",
      model: "FX506HF-HN024W",
      specs: "Intel Core i5 11400H | 16GB DDR4 | 512GB PCIe SSD | 4GB NVIDIA RTX 3050 | 144Hz FHD Display",
      purchasePrice: 48000,
      sellingPrice: 54990,
      mrp: 68990,
      gstRate: 18,
      stock: 7,
      minStock: 3,
      warranty: "1 Year International",
      status: "Active",
      rating: 4.8,
      image: "laptop-tuf.jpg",
      isFeatured: true
    },
    {
      id: "PROD-1005",
      name: "Acer Aspire 5 Slim Notebook",
      sku: "ACER-ASP5-I5",
      category: "Laptops",
      subcategory: "Student Laptop",
      brand: "Acer",
      model: "A515-58M",
      specs: "Intel Core i5 1335U | 8GB DDR5 | 512GB SSD | 15.6\" Full HD IPS | WiFi 6E | Win 11 Home",
      purchasePrice: 36000,
      sellingPrice: 40990,
      mrp: 49990,
      gstRate: 18,
      stock: 15,
      minStock: 5,
      warranty: "1 Year Domestic Warranty",
      status: "Active",
      rating: 4.4,
      image: "laptop-acer.jpg",
      isFeatured: false
    },
    {
      id: "PROD-1006",
      name: "ASUS ROG Strix G16 Gaming Laptop",
      sku: "ASUS-ROG-G16",
      category: "Laptops",
      subcategory: "Gaming Laptop",
      brand: "ASUS",
      model: "G614JU-N3193W",
      specs: "Intel Core i7 13650HX | 16GB DDR5 4800MHz | 1TB NVMe Gen4 | 6GB NVIDIA RTX 4050 (140W) | 165Hz FHD+",
      purchasePrice: 96000,
      sellingPrice: 108990,
      mrp: 129990,
      gstRate: 18,
      stock: 4,
      minStock: 2,
      warranty: "1 Year Onsite Warranty",
      status: "Active",
      rating: 4.9,
      image: "laptop-rog.jpg",
      isFeatured: true
    },

    // Desktop Computers (Pre-built)
    {
      id: "PROD-2001",
      name: "Hari Om Pro Office PC i3 12th Gen",
      sku: "HOC-DESK-OFFICE-I3",
      category: "Desktop Computers",
      subcategory: "Office PC",
      brand: "Intel",
      model: "HOC-OFFICE-V1",
      specs: "Intel Core i3 12100 | H610M Motherboard | 8GB DDR4 | 512GB NVMe SSD | 450W SMPS | Slim Office Cabinet",
      purchasePrice: 17500,
      sellingPrice: 21990,
      mrp: 27990,
      gstRate: 18,
      stock: 10,
      minStock: 3,
      warranty: "3 Years Hardware Warranty",
      status: "Active",
      rating: 4.6,
      image: "pc-office.jpg",
      isFeatured: true
    },
    {
      id: "PROD-2002",
      name: "Hari Om Business Tower i5 13th Gen",
      sku: "HOC-DESK-BIZ-I5",
      category: "Desktop Computers",
      subcategory: "Office PC",
      brand: "Intel",
      model: "HOC-BIZ-TOWER",
      specs: "Intel Core i5 13400 | B760M Motherboard | 16GB DDR5 | 1TB Gen4 NVMe | 550W Bronze PSU | Antec Cabinet",
      purchasePrice: 34000,
      sellingPrice: 39990,
      mrp: 48990,
      gstRate: 18,
      stock: 8,
      minStock: 2,
      warranty: "3 Years Hardware Warranty",
      status: "Active",
      rating: 4.8,
      image: "pc-biz.jpg",
      isFeatured: false
    },
    {
      id: "PROD-2003",
      name: "Hari Om Beast Gaming PC - RTX 4060",
      sku: "HOC-GAME-BEAST-4060",
      category: "Desktop Computers",
      subcategory: "Gaming PC",
      brand: "NVIDIA",
      model: "HOC-BEAST-4060",
      specs: "Intel Core i5 14400F | B760 WiFi | 16GB DDR5 5600MHz | 1TB NVMe Gen4 | 8GB RTX 4060 | 650W PSU | RGB Glass Cabinet",
      purchasePrice: 62000,
      sellingPrice: 72990,
      mrp: 87990,
      gstRate: 18,
      stock: 5,
      minStock: 2,
      warranty: "3 Years Comprehensive Warranty",
      status: "Active",
      rating: 4.9,
      image: "pc-gaming.jpg",
      isFeatured: true
    },
    {
      id: "PROD-2004",
      name: "Hari Om Creator 4K Video Editing Workstation",
      sku: "HOC-WORK-CREATOR-4070",
      category: "Desktop Computers",
      subcategory: "Editing Workstation",
      brand: "Intel",
      model: "HOC-STUDIO-PRO",
      specs: "Intel Core i7 14700K | Z790 DDR5 | 32GB (16x2) DDR5 6000MHz | 2TB Samsung 990 Pro | 12GB RTX 4070 | 360mm AIO Liquid Cooler | 850W Gold PSU",
      purchasePrice: 132000,
      sellingPrice: 149990,
      mrp: 175000,
      gstRate: 18,
      stock: 3,
      minStock: 1,
      warranty: "3 Years Hardware Warranty",
      status: "Active",
      rating: 5.0,
      image: "pc-workstation.jpg",
      isFeatured: true
    },

    // Processors (CPUs)
    {
      id: "PROD-3001",
      name: "Intel Core i3-14100 Processor",
      sku: "INTEL-I3-14100",
      category: "Components",
      subcategory: "Processor",
      brand: "Intel",
      model: "Core i3 14th Gen",
      specs: "4 Cores (4 P-Cores), 8 Threads, up to 4.7 GHz, LGA1700, 60W Base",
      purchasePrice: 9400,
      sellingPrice: 10890,
      mrp: 13500,
      gstRate: 18,
      stock: 18,
      minStock: 5,
      warranty: "3 Years Intel Direct Warranty",
      status: "Active",
      rating: 4.6,
      image: "cpu-intel-i3.jpg",
      socket: "LGA1700",
      pcbType: "cpu"
    },
    {
      id: "PROD-3002",
      name: "Intel Core i5-14400 Processor",
      sku: "INTEL-I5-14400",
      category: "Components",
      subcategory: "Processor",
      brand: "Intel",
      model: "Core i5 14th Gen",
      specs: "10 Cores (6P + 4E), 16 Threads, up to 4.7 GHz, UHD 730 Graphics, LGA1700",
      purchasePrice: 17200,
      sellingPrice: 19890,
      mrp: 23500,
      gstRate: 18,
      stock: 14,
      minStock: 4,
      warranty: "3 Years Intel Direct Warranty",
      status: "Active",
      rating: 4.8,
      image: "cpu-intel-i5.jpg",
      socket: "LGA1700",
      pcbType: "cpu"
    },
    {
      id: "PROD-3003",
      name: "Intel Core i7-14700 Processor",
      sku: "INTEL-I7-14700",
      category: "Components",
      subcategory: "Processor",
      brand: "Intel",
      model: "Core i7 14th Gen",
      specs: "20 Cores (8P + 12E), 28 Threads, up to 5.4 GHz, 33MB Cache, LGA1700",
      purchasePrice: 29500,
      sellingPrice: 33990,
      mrp: 39990,
      gstRate: 18,
      stock: 8,
      minStock: 3,
      warranty: "3 Years Intel Direct Warranty",
      status: "Active",
      rating: 4.9,
      image: "cpu-intel-i7.jpg",
      socket: "LGA1700",
      pcbType: "cpu"
    },
    {
      id: "PROD-3004",
      name: "AMD Ryzen 5 7600 Processor",
      sku: "AMD-RYZ-5-7600",
      category: "Components",
      subcategory: "Processor",
      brand: "AMD",
      model: "Ryzen 5 7000 Series",
      specs: "6 Cores, 12 Threads, 3.8 GHz Base / 5.1 GHz Boost, AM5 Socket, PCIe 5.0",
      purchasePrice: 15600,
      sellingPrice: 17990,
      mrp: 22000,
      gstRate: 18,
      stock: 11,
      minStock: 3,
      warranty: "3 Years AMD Warranty",
      status: "Active",
      rating: 4.7,
      image: "cpu-amd-r5.jpg",
      socket: "AM5",
      pcbType: "cpu"
    },
    {
      id: "PROD-3005",
      name: "AMD Ryzen 7 7800X3D Processor",
      sku: "AMD-RYZ-7-7800X3D",
      category: "Components",
      subcategory: "Processor",
      brand: "AMD",
      model: "Ryzen 7 3D V-Cache",
      specs: "8 Cores, 16 Threads, 104MB Cache, 5.0 GHz Boost, Best Gaming CPU on AM5",
      purchasePrice: 33000,
      sellingPrice: 38490,
      mrp: 46000,
      gstRate: 18,
      stock: 6,
      minStock: 2,
      warranty: "3 Years AMD Warranty",
      status: "Active",
      rating: 5.0,
      image: "cpu-amd-r7.jpg",
      socket: "AM5",
      pcbType: "cpu"
    },

    // Motherboards
    {
      id: "PROD-3101",
      name: "MSI PRO H610M-E DDR4 Motherboard",
      sku: "MSI-H610M-E",
      category: "Components",
      subcategory: "Motherboard",
      brand: "MSI",
      model: "PRO H610M-E",
      specs: "LGA1700 Socket, DDR4 Dual Channel, PCIe 4.0, M.2 NVMe Slot, HDMI/VGA",
      purchasePrice: 5300,
      sellingPrice: 6290,
      mrp: 7500,
      gstRate: 18,
      stock: 15,
      minStock: 4,
      warranty: "3 Years Brand Warranty",
      status: "Active",
      rating: 4.5,
      image: "mobo-msi-h610.jpg",
      socket: "LGA1700",
      ramType: "DDR4",
      pcbType: "motherboard"
    },
    {
      id: "PROD-3102",
      name: "MSI B760 GAMING PLUS WIFI Motherboard",
      sku: "MSI-B760-WIFI",
      category: "Components",
      subcategory: "Motherboard",
      brand: "MSI",
      model: "B760 Gaming Plus WiFi",
      specs: "LGA1700 Socket (12/13/14th Gen), DDR5 up to 6800+ MHz, 2x M.2 Gen4, WiFi 6E + BT",
      purchasePrice: 13200,
      sellingPrice: 15490,
      mrp: 18500,
      gstRate: 18,
      stock: 9,
      minStock: 3,
      warranty: "3 Years Brand Warranty",
      status: "Active",
      rating: 4.8,
      image: "mobo-msi-b760.jpg",
      socket: "LGA1700",
      ramType: "DDR5",
      pcbType: "motherboard"
    },
    {
      id: "PROD-3103",
      name: "ASUS TUF GAMING B650-PLUS WIFI Motherboard",
      sku: "ASUS-B650-TUF",
      category: "Components",
      subcategory: "Motherboard",
      brand: "ASUS",
      model: "TUF GAMING B650-PLUS",
      specs: "Socket AM5 (Ryzen 7000/8000/9000), DDR5 6400+, PCIe 5.0 M.2, 2.5G LAN, WiFi 6",
      purchasePrice: 17400,
      sellingPrice: 19990,
      mrp: 24000,
      gstRate: 18,
      stock: 7,
      minStock: 2,
      warranty: "3 Years Asus India Warranty",
      status: "Active",
      rating: 4.9,
      image: "mobo-asus-b650.jpg",
      socket: "AM5",
      ramType: "DDR5",
      pcbType: "motherboard"
    },

    // RAM Memory
    {
      id: "PROD-3201",
      name: "Kingston Fury Beast 8GB DDR4 3200MHz RAM",
      sku: "KING-FURY-8GB-D4",
      category: "Components",
      subcategory: "RAM",
      brand: "Kingston",
      model: "Fury Beast 8GB DDR4",
      specs: "8GB DDR4 3200MHz CL16 Desktop Memory with Heatspreader",
      purchasePrice: 1450,
      sellingPrice: 1790,
      mrp: 2600,
      gstRate: 18,
      stock: 35,
      minStock: 8,
      warranty: "Limited Lifetime Warranty",
      status: "Active",
      rating: 4.7,
      image: "ram-kingston-8gb.jpg",
      ramType: "DDR4",
      pcbType: "ram"
    },
    {
      id: "PROD-3202",
      name: "Kingston Fury Beast 16GB DDR5 5600MHz RAM",
      sku: "KING-FURY-16GB-D5",
      category: "Components",
      subcategory: "RAM",
      brand: "Kingston",
      model: "Fury Beast 16GB DDR5",
      specs: "16GB DDR5 5600MHz CL36 Intel XMP 3.0 & AMD EXPO Ready",
      purchasePrice: 3800,
      sellingPrice: 4490,
      mrp: 6200,
      gstRate: 18,
      stock: 22,
      minStock: 5,
      warranty: "Limited Lifetime Warranty",
      status: "Active",
      rating: 4.8,
      image: "ram-kingston-16gb.jpg",
      ramType: "DDR5",
      pcbType: "ram"
    },
    {
      id: "PROD-3203",
      name: "Corsair Vengeance RGB 32GB (16x2) DDR5 6000MHz",
      sku: "CORS-VEN-32GB-RGB",
      category: "Components",
      subcategory: "RAM",
      brand: "Corsair",
      model: "Vengeance RGB DDR5",
      specs: "32GB (2x16GB) DDR5 6000MHz CL30 Optimised for Intel & AMD",
      purchasePrice: 8800,
      sellingPrice: 10490,
      mrp: 13500,
      gstRate: 18,
      stock: 11,
      minStock: 3,
      warranty: "10 Years Brand Warranty",
      status: "Active",
      rating: 4.9,
      image: "ram-corsair-32gb.jpg",
      ramType: "DDR5",
      pcbType: "ram"
    },

    // Storage (SSDs & HDDs)
    {
      id: "PROD-3301",
      name: "Crucial P3 512GB PCIe 3.0 M.2 NVMe SSD",
      sku: "CRU-P3-512GB",
      category: "Components",
      subcategory: "SSD",
      brand: "Kingston",
      model: "Crucial P3 512GB",
      specs: "Read speeds up to 3500 MB/s, 3D NAND M.2 2280",
      purchasePrice: 2600,
      sellingPrice: 3190,
      mrp: 4500,
      gstRate: 18,
      stock: 28,
      minStock: 6,
      warranty: "5 Years Limited Warranty",
      status: "Active",
      rating: 4.6,
      image: "ssd-crucial-512.jpg",
      pcbType: "storage"
    },
    {
      id: "PROD-3302",
      name: "Samsung 990 PRO 1TB PCIe 4.0 NVMe M.2 SSD",
      sku: "SAM-990PRO-1TB",
      category: "Components",
      subcategory: "SSD",
      brand: "Samsung",
      model: "990 PRO 1TB",
      specs: "Ultra-fast Read 7,450MB/s, Write 6,900MB/s with V-NAND Technology",
      purchasePrice: 8200,
      sellingPrice: 9690,
      mrp: 13990,
      gstRate: 18,
      stock: 14,
      minStock: 4,
      warranty: "5 Years Samsung Warranty",
      status: "Active",
      rating: 4.9,
      image: "ssd-samsung-1tb.jpg",
      pcbType: "storage"
    },
    {
      id: "PROD-3303",
      name: "Western Digital WD Blue 1TB 7200 RPM HDD",
      sku: "WD-BLUE-1TB-HDD",
      category: "Components",
      subcategory: "HDD",
      brand: "Western Digital",
      model: "WD10EZEX",
      specs: "1TB 3.5-inch SATA 6 Gb/s 7200 RPM 64MB Cache Hard Drive",
      purchasePrice: 3200,
      sellingPrice: 3790,
      mrp: 4800,
      gstRate: 18,
      stock: 19,
      minStock: 5,
      warranty: "2 Years Brand Warranty",
      status: "Active",
      rating: 4.5,
      image: "hdd-wd-1tb.jpg",
      pcbType: "storage"
    },

    // Graphics Cards (GPUs)
    {
      id: "PROD-3401",
      name: "MSI GeForce RTX 3050 Ventus 2X 6GB OC",
      sku: "MSI-RTX3050-6G",
      category: "Components",
      subcategory: "Graphics Card",
      brand: "MSI",
      model: "RTX 3050 6GB",
      specs: "6GB GDDR6, Ray Tracing, DLSS, Dual Fan, HDMI/DP, 70W Low Power",
      purchasePrice: 14800,
      sellingPrice: 16990,
      mrp: 21000,
      gstRate: 18,
      stock: 8,
      minStock: 2,
      warranty: "3 Years Brand Warranty",
      status: "Active",
      rating: 4.6,
      image: "gpu-rtx3050.jpg",
      wattageReq: 450,
      pcbType: "gpu"
    },
    {
      id: "PROD-3402",
      name: "Gigabyte GeForce RTX 4060 WINDFORCE OC 8GB",
      sku: "GIGA-RTX4060-8G",
      category: "Components",
      subcategory: "Graphics Card",
      brand: "Gigabyte",
      model: "RTX 4060 Windforce 8G",
      specs: "8GB GDDR6, Ada Lovelace Architecture, DLSS 3 Frame Gen, 115W TGP",
      purchasePrice: 25500,
      sellingPrice: 28990,
      mrp: 34990,
      gstRate: 18,
      stock: 6,
      minStock: 2,
      warranty: "3+1 Years Brand Warranty",
      status: "Active",
      rating: 4.8,
      image: "gpu-rtx4060.jpg",
      wattageReq: 550,
      pcbType: "gpu"
    },
    {
      id: "PROD-3403",
      name: "ASUS Dual GeForce RTX 4070 SUPER 12GB OC",
      sku: "ASUS-RTX4070S-12G",
      category: "Components",
      subcategory: "Graphics Card",
      brand: "ASUS",
      model: "RTX 4070 Super Dual OC",
      specs: "12GB GDDR6X, 7168 CUDA Cores, DLSS 3.5, 220W TGP, Excellent 1440p & 4K Gaming",
      purchasePrice: 53000,
      sellingPrice: 59990,
      mrp: 72000,
      gstRate: 18,
      stock: 4,
      minStock: 1,
      warranty: "3 Years Asus Warranty",
      status: "Active",
      rating: 4.9,
      image: "gpu-rtx4070s.jpg",
      wattageReq: 650,
      pcbType: "gpu"
    },

    // Power Supplies (SMPS)
    {
      id: "PROD-3501",
      name: "Ant Esports VS450L 450W Power Supply",
      sku: "ANT-VS450L",
      category: "Components",
      subcategory: "SMPS/PSU",
      brand: "Corsair",
      model: "VS450L",
      specs: "450 Watt, 120mm Silent Fan, Over Voltage & Power Protection",
      purchasePrice: 1400,
      sellingPrice: 1790,
      mrp: 2400,
      gstRate: 18,
      stock: 20,
      minStock: 4,
      warranty: "2 Years Brand Warranty",
      status: "Active",
      rating: 4.3,
      image: "psu-450w.jpg",
      wattage: 450,
      pcbType: "psu"
    },
    {
      id: "PROD-3502",
      name: "Corsair CX650 650W 80 PLUS Bronze PSU",
      sku: "CORS-CX650",
      category: "Components",
      subcategory: "SMPS/PSU",
      brand: "Corsair",
      model: "CX650 Bronze",
      specs: "650W Continuous Power, 80 Plus Bronze Certified, Low Noise 120mm Fan",
      purchasePrice: 4200,
      sellingPrice: 4990,
      mrp: 6500,
      gstRate: 18,
      stock: 12,
      minStock: 3,
      warranty: "5 Years Corsair Warranty",
      status: "Active",
      rating: 4.8,
      image: "psu-corsair-650w.jpg",
      wattage: 650,
      pcbType: "psu"
    },
    {
      id: "PROD-3503",
      name: "Corsair RM850e 850W 80 PLUS Gold Fully Modular",
      sku: "CORS-RM850E",
      category: "Components",
      subcategory: "SMPS/PSU",
      brand: "Corsair",
      model: "RM850e Fully Modular",
      specs: "850W ATX 3.0 & PCIe 5.0 Ready, 80+ Gold Efficiency, 105°C Capacitors",
      purchasePrice: 8900,
      sellingPrice: 10490,
      mrp: 13500,
      gstRate: 18,
      stock: 5,
      minStock: 2,
      warranty: "7 Years Corsair Warranty",
      status: "Active",
      rating: 4.9,
      image: "psu-corsair-850w.jpg",
      wattage: 850,
      pcbType: "psu"
    },

    // Cabinets
    {
      id: "PROD-3601",
      name: "Frontech Elegant Micro-ATX Office Cabinet",
      sku: "FRON-ELEG-CAB",
      category: "Components",
      subcategory: "Cabinet",
      brand: "Corsair",
      model: "Frontech Elegant",
      specs: "Compact Micro-ATX Case, Front USB 3.0 & Audio, Built-in Standard PSU Mount",
      purchasePrice: 950,
      sellingPrice: 1290,
      mrp: 1800,
      gstRate: 18,
      stock: 25,
      minStock: 5,
      warranty: "1 Year Warranty",
      status: "Active",
      rating: 4.2,
      image: "cab-office.jpg",
      pcbType: "cabinet"
    },
    {
      id: "PROD-3602",
      name: "Ant Esports ICE-112 Mid-Tower RGB Gaming Cabinet",
      sku: "ANT-ICE-112",
      category: "Components",
      subcategory: "Cabinet",
      brand: "Corsair",
      model: "ICE-112 RGB",
      specs: "Tempered Glass Side Panel, 4x Pre-installed 120mm Auto-RGB Fans, Mesh Front",
      purchasePrice: 2600,
      sellingPrice: 3290,
      mrp: 4500,
      gstRate: 18,
      stock: 14,
      minStock: 3,
      warranty: "1 Year Brand Warranty",
      status: "Active",
      rating: 4.7,
      image: "cab-rgb.jpg",
      pcbType: "cabinet"
    },

    // CPU Coolers
    {
      id: "PROD-3701",
      name: "Stock Air Cooler (Included in Box)",
      sku: "COOL-STOCK-BOX",
      category: "Components",
      subcategory: "CPU Cooler",
      brand: "Intel",
      model: "Stock Box Cooler",
      specs: "Standard OEM Air Cooler suitable for 65W base processors",
      purchasePrice: 0,
      sellingPrice: 0,
      mrp: 500,
      gstRate: 18,
      stock: 99,
      minStock: 10,
      warranty: "Processor Included",
      status: "Active",
      rating: 4.0,
      image: "cooler-stock.jpg",
      pcbType: "cooler"
    },
    {
      id: "PROD-3702",
      name: "Deepcool AG400 ARGB 120mm CPU Air Cooler",
      sku: "DEEP-AG400-ARGB",
      category: "Components",
      subcategory: "CPU Cooler",
      brand: "Corsair",
      model: "Deepcool AG400",
      specs: "4 Direct Contact Heat Pipes, 220W TDP Cooling Capacity, Addressable RGB Fan",
      purchasePrice: 1550,
      sellingPrice: 1990,
      mrp: 2800,
      gstRate: 18,
      stock: 16,
      minStock: 4,
      warranty: "3 Years Brand Warranty",
      status: "Active",
      rating: 4.8,
      image: "cooler-air.jpg",
      pcbType: "cooler"
    },

    // Monitors & Displays
    {
      id: "PROD-4001",
      name: "Dell 24\" S2421HN FHD IPS Monitor",
      sku: "DELL-24-S2421HN",
      category: "Display & Monitors",
      subcategory: "LED Monitor",
      brand: "Dell",
      model: "S2421HN 24-Inch",
      specs: "23.8\" Full HD (1920x1080) IPS, 75Hz, 4ms, AMD FreeSync, 2x HDMI, 3-Sided Ultrathin Bezel",
      purchasePrice: 7600,
      sellingPrice: 8990,
      mrp: 12500,
      gstRate: 18,
      stock: 15,
      minStock: 4,
      warranty: "3 Years Dell Advanced Exchange",
      status: "Active",
      rating: 4.7,
      image: "mon-dell-24.jpg",
      pcbType: "monitor",
      isFeatured: true
    },
    {
      id: "PROD-4002",
      name: "LG UltraGear 27\" 165Hz IPS QHD Gaming Monitor",
      sku: "LG-27GR75Q",
      category: "Display & Monitors",
      subcategory: "Gaming Monitor",
      brand: "Samsung",
      model: "27GR75Q-B",
      specs: "27\" 2K QHD (2560x1440) IPS, 165Hz, 1ms MBR, HDR10, G-Sync Compatible, DisplayPort/HDMI",
      purchasePrice: 17800,
      sellingPrice: 20990,
      mrp: 28000,
      gstRate: 18,
      stock: 6,
      minStock: 2,
      warranty: "3 Years LG India Warranty",
      status: "Active",
      rating: 4.9,
      image: "mon-lg-27.jpg",
      pcbType: "monitor"
    },

    // Peripherals & Accessories
    {
      id: "PROD-5001",
      name: "Logitech MK215 Wireless Keyboard and Mouse Combo",
      sku: "LOGI-MK215",
      category: "Accessories",
      subcategory: "Keyboard & Mouse",
      brand: "Logitech",
      model: "MK215 Wireless",
      specs: "Compact 2.4GHz Wireless Combo, 10m range, 24-month KB / 5-month Mouse battery life",
      purchasePrice: 1050,
      sellingPrice: 1299,
      mrp: 1645,
      gstRate: 18,
      stock: 45,
      minStock: 10,
      warranty: "3 Years Logitech Replacement",
      status: "Active",
      rating: 4.6,
      image: "acc-logi-combo.jpg",
      pcbType: "peripherals",
      isFeatured: true
    },
    {
      id: "PROD-5002",
      name: "Logitech G213 Prodigy RGB Gaming Keyboard",
      sku: "LOGI-G213",
      category: "Accessories",
      subcategory: "Keyboard & Mouse",
      brand: "Logitech",
      model: "G213 Prodigy",
      specs: "LIGHTSYNC RGB Backlit Keys, Spill-Resistant, Integrated Palm Rest, Dedicated Media Controls",
      purchasePrice: 3100,
      sellingPrice: 3790,
      mrp: 4995,
      gstRate: 18,
      stock: 14,
      minStock: 3,
      warranty: "2 Years Logitech Warranty",
      status: "Active",
      rating: 4.7,
      image: "acc-logi-g213.jpg",
      pcbType: "peripherals"
    },
    {
      id: "PROD-6001",
      name: "TP-Link Archer C6 AC1200 Dual Band Gigabit Router",
      sku: "TPL-ARCHER-C6",
      category: "Networking",
      subcategory: "WiFi Router",
      brand: "TP-Link",
      model: "Archer C6 V4",
      specs: "867 Mbps at 5GHz + 300 Mbps at 2.4GHz, 4 External Antennas, MU-MIMO, Access Point Mode",
      purchasePrice: 1850,
      sellingPrice: 2249,
      mrp: 2999,
      gstRate: 18,
      stock: 20,
      minStock: 5,
      warranty: "3 Years Brand Warranty",
      status: "Active",
      rating: 4.6,
      image: "net-tplink-c6.jpg"
    }
  ],

  customers: [
    {
      id: "CUST-001",
      name: "Vikram Rathore",
      company: "Rathore Infotech Pvt Ltd",
      mobile: "+91 98291 55667",
      email: "vikram@rathoreinfotech.com",
      gstin: "08AABCR1234F1Z3",
      type: "Corporate",
      address: "14, Industrial Area, Phase II",
      city: "Jodhpur",
      state: "Rajasthan",
      pincode: "342005",
      totalPurchases: 285400,
      totalQuotes: 5,
      pendingPayment: 0,
      status: "Active"
    },
    {
      id: "CUST-002",
      name: "Pooja Sharma",
      company: "Creative Design Studio",
      mobile: "+91 94142 88990",
      email: "pooja.sharma@gmail.com",
      gstin: "08BCDPS9876G1ZA",
      type: "Retail",
      address: "B-22, Shastri Nagar",
      city: "Jodhpur",
      state: "Rajasthan",
      pincode: "342003",
      totalPurchases: 149990,
      totalQuotes: 2,
      pendingPayment: 15000,
      status: "Active"
    },
    {
      id: "CUST-003",
      name: "Amit Choudhary",
      company: "Marwar High School & Academy",
      mobile: "+91 98280 44332",
      email: "principal@marwarschool.org",
      gstin: "08AAATM5544N1ZV",
      type: "Institution",
      address: "Pal Road, Near DPS",
      city: "Jodhpur",
      state: "Rajasthan",
      pincode: "342008",
      totalPurchases: 439800,
      totalQuotes: 4,
      pendingPayment: 45000,
      status: "Active"
    },
    {
      id: "CUST-004",
      name: "Rahul Gehlot",
      company: "Gehlot E-Commerce Hub",
      mobile: "+91 97845 11223",
      email: "rahul.gehlot@live.in",
      gstin: "",
      type: "Retail",
      address: "35, Sardarpura B-Road",
      city: "Jodhpur",
      state: "Rajasthan",
      pincode: "342001",
      totalPurchases: 72990,
      totalQuotes: 3,
      pendingPayment: 0,
      status: "Active"
    },
    {
      id: "CUST-005",
      name: "Dr. Sandeep Mehta",
      company: "Mehta Diagnostic & Imaging",
      mobile: "+91 94133 77665",
      email: "dr.sandeep@mehtadiagnostics.com",
      gstin: "08AAGSM4433E1ZK",
      type: "Corporate",
      address: "Medical College Road",
      city: "Jodhpur",
      state: "Rajasthan",
      pincode: "342003",
      totalPurchases: 185000,
      totalQuotes: 2,
      pendingPayment: 0,
      status: "Active"
    }
  ],

  quotations: [
    {
      id: "HOC/QTN/2026/0001",
      customerId: "CUST-001",
      customerName: "Vikram Rathore",
      company: "Rathore Infotech Pvt Ltd",
      mobile: "+91 98291 55667",
      email: "vikram@rathoreinfotech.com",
      gstin: "08AABCR1234F1Z3",
      address: "14, Industrial Area, Phase II, Jodhpur",
      date: "2026-08-10",
      validUntil: "2026-08-25",
      salesPerson: "Sunil Sharma",
      status: "Approved",
      items: [
        {
          productId: "PROD-1002",
          name: "HP Pavilion 15 (2025 Edition)",
          sku: "HP-PAV-15-EG",
          qty: 2,
          rate: 58042.37, // Base rate excl GST
          gstRate: 18,
          discount: 1000,
          amount: 135000
        },
        {
          productId: "PROD-4001",
          name: "Dell 24\" S2421HN FHD IPS Monitor",
          sku: "DELL-24-S2421HN",
          qty: 2,
          rate: 7618.64,
          gstRate: 18,
          discount: 0,
          amount: 17980
        }
      ],
      subtotal: 129644.06,
      discountTotal: 1000,
      gstTotal: 23335.94,
      roundOff: 0,
      grandTotal: 152980,
      notes: "Urgent delivery required for office software rollout."
    },
    {
      id: "HOC/QTN/2026/0002",
      customerId: "CUST-002",
      customerName: "Pooja Sharma",
      company: "Creative Design Studio",
      mobile: "+91 94142 88990",
      email: "pooja.sharma@gmail.com",
      gstin: "08BCDPS9876G1ZA",
      address: "B-22, Shastri Nagar, Jodhpur",
      date: "2026-08-12",
      validUntil: "2026-08-27",
      salesPerson: "Kailash Verma",
      status: "Sent",
      items: [
        {
          productId: "PROD-2004",
          name: "Hari Om Creator 4K Video Editing Workstation",
          sku: "HOC-WORK-CREATOR-4070",
          qty: 1,
          rate: 127110.17,
          gstRate: 18,
          discount: 3000,
          amount: 146990
        }
      ],
      subtotal: 124567.80,
      discountTotal: 3000,
      gstTotal: 22422.20,
      roundOff: 0,
      grandTotal: 146990,
      notes: "Custom build with pre-configured DaVinci Resolve color profiles."
    },
    {
      id: "HOC/QTN/2026/0003",
      customerId: "CUST-003",
      customerName: "Amit Choudhary",
      company: "Marwar High School & Academy",
      mobile: "+91 98280 44332",
      email: "principal@marwarschool.org",
      gstin: "08AAATM5544N1ZV",
      address: "Pal Road, Jodhpur",
      date: "2026-08-13",
      validUntil: "2026-08-28",
      salesPerson: "Sunil Sharma",
      status: "Pending",
      items: [
        {
          productId: "PROD-2001",
          name: "Hari Om Pro Office PC i3 12th Gen",
          sku: "HOC-DESK-OFFICE-I3",
          qty: 10,
          rate: 18635.59,
          gstRate: 18,
          discount: 5000,
          amount: 214900
        },
        {
          productId: "PROD-5001",
          name: "Logitech MK215 Wireless Combo",
          sku: "LOGI-MK215",
          qty: 10,
          rate: 1100.85,
          gstRate: 18,
          discount: 0,
          amount: 12990
        }
      ],
      subtotal: 193127.12,
      discountTotal: 5000,
      gstTotal: 34762.88,
      roundOff: 0,
      grandTotal: 227890,
      notes: "Computer Lab Batch 1 quotation."
    },
    {
      id: "HOC/QTN/2026/0004",
      customerId: "CUST-004",
      customerName: "Rahul Gehlot",
      company: "Gehlot E-Commerce Hub",
      mobile: "+91 97845 11223",
      email: "rahul.gehlot@live.in",
      gstin: "",
      address: "35, Sardarpura B-Road, Jodhpur",
      date: "2026-08-14",
      validUntil: "2026-08-29",
      salesPerson: "Kailash Verma",
      status: "Draft",
      items: [
        {
          productId: "PROD-2003",
          name: "Hari Om Beast Gaming PC - RTX 4060",
          sku: "HOC-GAME-BEAST-4060",
          qty: 1,
          rate: 61855.93,
          gstRate: 18,
          discount: 1000,
          amount: 71990
        }
      ],
      subtotal: 61008.47,
      discountTotal: 1000,
      gstTotal: 10981.53,
      roundOff: 0,
      grandTotal: 71990,
      notes: "Customer inquiring about exchange of old laptop."
    }
  ],

  sales: [
    {
      invoiceNo: "HOC/INV/2026/0001",
      quotationNo: "HOC/QTN/2026/0001",
      customerName: "Vikram Rathore",
      company: "Rathore Infotech Pvt Ltd",
      date: "2026-08-11",
      amount: 152980,
      paidAmount: 152980,
      paymentStatus: "Paid",
      paymentMethod: "Bank Transfer (NEFT)",
      salesPerson: "Sunil Sharma",
      itemsCount: 4
    },
    {
      invoiceNo: "HOC/INV/2026/0002",
      quotationNo: "",
      customerName: "Dr. Sandeep Mehta",
      company: "Mehta Diagnostic & Imaging",
      date: "2026-08-13",
      amount: 185000,
      paidAmount: 185000,
      paymentStatus: "Paid",
      paymentMethod: "UPI / Cheque",
      salesPerson: "Sunil Sharma",
      itemsCount: 3
    }
  ],

  suppliers: [
    {
      id: "SUP-01",
      name: "CompAge Infotech India Ltd",
      company: "CompAge India",
      mobile: "+91 22 67890000",
      email: "orders@compageindia.com",
      gstin: "27AAACC1234F1Z8",
      address: "Nehru Place & Mumbai Distribution",
      paymentTerms: "30 Days Credit",
      status: "Active"
    },
    {
      id: "SUP-02",
      name: "Rashi Peripherals Ltd",
      company: "Rashi Peripherals",
      mobile: "+91 22 28250000",
      email: "jodhpur.hub@rptechindia.com",
      gstin: "08AAACR5678G1Z4",
      address: "Jaipur Regional Warehouse, Rajasthan",
      paymentTerms: "15 Days Credit",
      status: "Active"
    },
    {
      id: "SUP-03",
      name: "Supertron Electronics Pvt Ltd",
      company: "Supertron",
      mobile: "+91 33 22340000",
      email: "sales@supertronindia.com",
      gstin: "19AAACS9012H1Z2",
      address: "Jaipur Depot, MI Road",
      paymentTerms: "Advance / 21 Days",
      status: "Active"
    }
  ],

  purchases: [
    {
      id: "PUR-2026-001",
      supplier: "Rashi Peripherals Ltd",
      invoiceNo: "RPTECH/JAI/44892",
      date: "2026-08-05",
      product: "Intel Core i5-14400 & ASUS B760 Motherboards",
      qty: 15,
      rate: 16500,
      gst: 44550,
      total: 292050,
      status: "Received"
    },
    {
      id: "PUR-2026-002",
      supplier: "CompAge Infotech India Ltd",
      invoiceNo: "COMP/DEL/90123",
      date: "2026-08-08",
      product: "Dell Inspiron 15 3520 Laptops",
      qty: 10,
      rate: 42000,
      gst: 75600,
      total: 495600,
      status: "Received"
    }
  ],

  payments: [
    {
      id: "PAY-001",
      invoiceNo: "HOC/INV/2026/0001",
      customer: "Vikram Rathore (Rathore Infotech)",
      amount: 152980,
      method: "Bank Transfer",
      reference: "HDFC-N98765432",
      date: "2026-08-11",
      status: "Completed"
    },
    {
      id: "PAY-002",
      invoiceNo: "HOC/INV/2026/0002",
      customer: "Dr. Sandeep Mehta",
      amount: 185000,
      method: "UPI",
      reference: "UPI/20260813/9837",
      date: "2026-08-13",
      status: "Completed"
    }
  ]
};

// Storage Management Engine
const DataStore = {
  KEY: "HARI_OM_COMPUTER_STORE_V1",

  init() {
    const existing = localStorage.getItem(this.KEY);
    if (!existing) {
      this.save(HOC_DATA);
      return HOC_DATA;
    }
    try {
      return JSON.parse(existing);
    } catch (e) {
      console.error("Failed to parse existing data, resetting to default", e);
      this.save(HOC_DATA);
      return HOC_DATA;
    }
  },

  get() {
    return this.init();
  },

  save(data) {
    localStorage.setItem(this.KEY, JSON.stringify(data));
  },

  getProducts() {
    return this.get().products || [];
  },

  getProductById(id) {
    return this.getProducts().find(p => p.id === id);
  },

  getQuotations() {
    return this.get().quotations || [];
  },

  getQuotationById(id) {
    return this.getQuotations().find(q => q.id === id);
  },

  saveQuotation(quote) {
    const data = this.get();
    if (!data.quotations) data.quotations = [];
    const index = data.quotations.findIndex(q => q.id === quote.id);
    if (index >= 0) {
      data.quotations[index] = quote;
    } else {
      data.quotations.unshift(quote);
    }
    this.save(data);
    return quote;
  },

  generateQuotationNumber() {
    const quotes = this.getQuotations();
    const count = quotes.length + 1;
    const padded = String(count).padStart(4, "0");
    return `HOC/QTN/2026/${padded}`;
  },

  generateInvoiceNumber() {
    const sales = this.get().sales || [];
    const count = sales.length + 1;
    const padded = String(count).padStart(4, "0");
    return `HOC/INV/2026/${padded}`;
  },

  convertQuotationToSale(quotationId, paymentMethod = "Cash") {
    const data = this.get();
    const quote = data.quotations.find(q => q.id === quotationId);
    if (!quote) return null;

    quote.status = "Approved";

    const invNo = this.generateInvoiceNumber();
    const newSale = {
      invoiceNo: invNo,
      quotationNo: quote.id,
      customerName: quote.customerName,
      company: quote.company || "",
      date: new Date().toISOString().split("T")[0],
      amount: quote.grandTotal,
      paidAmount: quote.grandTotal,
      paymentStatus: "Paid",
      paymentMethod: paymentMethod,
      salesPerson: quote.salesPerson || "Admin",
      itemsCount: quote.items.length
    };

    if (!data.sales) data.sales = [];
    data.sales.unshift(newSale);

    // Record payment
    const newPayment = {
      id: `PAY-${String(data.payments.length + 1).padStart(3, '0')}`,
      invoiceNo: invNo,
      customer: quote.customerName + (quote.company ? ` (${quote.company})` : ''),
      amount: quote.grandTotal,
      method: paymentMethod,
      reference: `AUTO-POS-${Date.now().toString().slice(-6)}`,
      date: new Date().toISOString().split("T")[0],
      status: "Completed"
    };
    if (!data.payments) data.payments = [];
    data.payments.unshift(newPayment);

    // Decrement inventory stock
    quote.items.forEach(item => {
      const prod = data.products.find(p => p.id === item.productId || p.sku === item.sku);
      if (prod) {
        prod.stock = Math.max(0, prod.stock - (item.qty || 1));
      }
    });

    this.save(data);
    return newSale;
  },

  // Enquiry Cart Storage
  getEnquiryCart() {
    try {
      const cart = localStorage.getItem("HOC_ENQUIRY_CART");
      return cart ? JSON.parse(cart) : [];
    } catch {
      return [];
    }
  },

  saveEnquiryCart(cart) {
    localStorage.setItem("HOC_ENQUIRY_CART", JSON.stringify(cart));
    window.dispatchEvent(new CustomEvent("hoc_cart_updated", { detail: cart }));
  },

  addToEnquiryCart(productId, qty = 1, customSpecs = null) {
    const cart = this.getEnquiryCart();
    const prod = this.getProductById(productId);
    if (!prod && !customSpecs) return;

    const existingIndex = cart.findIndex(item => item.id === productId);
    if (existingIndex >= 0) {
      cart[existingIndex].qty += qty;
    } else {
      cart.push({
        id: productId,
        name: prod ? prod.name : customSpecs.name,
        sku: prod ? prod.sku : "CUSTOM-BUILD",
        price: prod ? prod.sellingPrice : customSpecs.price,
        image: prod ? prod.image : "pc-gaming.jpg",
        category: prod ? prod.category : "Custom PC",
        specs: prod ? prod.specs : customSpecs.specs,
        qty: qty
      });
    }
    this.saveEnquiryCart(cart);
  },

  removeFromEnquiryCart(productId) {
    const cart = this.getEnquiryCart().filter(item => item.id !== productId);
    this.saveEnquiryCart(cart);
  },

  clearEnquiryCart() {
    this.saveEnquiryCart([]);
  }
};

// Utilities & Currency Formatters
const HOC_UTILS = {
  formatINR(amount) {
    if (isNaN(amount)) return "₹0";
    return "₹" + Number(amount).toLocaleString('en-IN', {
      maximumFractionDigits: 2,
      minimumFractionDigits: 0
    });
  },

  numberToWordsINR(amount) {
    const a = ['', 'One ', 'Two ', 'Three ', 'Four ', 'Five ', 'Six ', 'Seven ', 'Eight ', 'Nine ', 'Ten ', 'Eleven ', 'Twelve ', 'Thirteen ', 'Fourteen ', 'Fifteen ', 'Sixteen ', 'Seventeen ', 'Eighteen ', 'Nineteen '];
    const b = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

    function numToWords(n) {
      if (n === 0) return '';
      let str = '';
      if (n > 99) {
        str += a[Math.floor(n / 100)] + 'Hundred ';
        n %= 100;
      }
      if (n > 19) {
        str += b[Math.floor(n / 10)] + ' ' + a[n % 10];
      } else if (n > 0) {
        str += a[n];
      }
      return str;
    }

    const num = Math.floor(amount);
    if (num === 0) return "Zero Rupees Only";

    const crore = Math.floor(num / 10000000);
    const lakh = Math.floor((num % 10000000) / 100000);
    const thousand = Math.floor((num % 100000) / 1000);
    const hundred = num % 1000;

    let res = "";
    if (crore > 0) res += numToWords(crore) + 'Crore ';
    if (lakh > 0) res += numToWords(lakh) + 'Lakh ';
    if (thousand > 0) res += numToWords(thousand) + 'Thousand ';
    if (hundred > 0) res += numToWords(hundred);

    return (res.trim() + " Rupees Only").replace(/\s+/g, ' ');
  },

  showToast(message, type = 'success') {
    let container = document.getElementById('hoc-toast-container');
    if (!container) {
      container = document.createElement('div');
      container.id = 'hoc-toast-container';
      container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
      container.style.zIndex = '9999';
      document.body.appendChild(container);
    }

    const toastEl = document.createElement('div');
    toastEl.className = `toast align-items-center text-white bg-${type === 'success' ? 'success' : type === 'danger' ? 'danger' : 'primary'} border-0 shadow-lg`;
    toastEl.setAttribute('role', 'alert');
    toastEl.innerHTML = `
      <div class="d-flex">
        <div class="toast-body d-flex align-items-center gap-2">
          <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : type === 'danger' ? 'bi-exclamation-triangle-fill' : 'bi-info-circle-fill'}"></i>
          <span>${message}</span>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    `;
    container.appendChild(toastEl);
    const toast = new bootstrap.Toast(toastEl, { delay: 3500 });
    toast.show();
    toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
  }
};

// Initialize data store on script load
DataStore.init();
